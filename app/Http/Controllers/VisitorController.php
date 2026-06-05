<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VisitorController extends Controller
{
    /**
     * Helper to read & validate the current language (id|en).
     */
    private function lang(Request $request): string
    {
        return $request->query('lang') === 'en' ? 'en' : 'id';
    }

    /**
     * GET /visitor-form — show the registration form.
     */
    public function form(Request $request)
    {
        $lang = $this->lang($request);
        $t    = config("content.visitor_form.{$lang}");

        return view('visitor_form', compact('lang', 't'));
    }

    /**
     * POST /visitor-form — store a new visitor entry.
     */
    public function store(Request $request)
    {
        $lang = $this->lang($request);
        $t    = config("content.visitor_form.{$lang}");

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:2',  'max:100'],
            'domisili'     => ['required', 'string', 'min:2',  'max:100'],
            'email'        => ['required', 'email',  'max:150'],
        ], [
            'nama_lengkap.required' => $t['errNameMin'],
            'nama_lengkap.min'      => $t['errNameMin'],
            'nama_lengkap.max'      => $t['errNameMax'],
            'domisili.required'     => $t['errCityMin'],
            'domisili.min'          => $t['errCityMin'],
            'domisili.max'          => $t['errCityMax'],
            'email.required'        => $t['errEmailInvalid'],
            'email.email'           => $t['errEmailInvalid'],
            'email.max'             => $t['errEmailMax'],
        ]);

        Visitor::create([
            'nama_lengkap' => trim($validated['nama_lengkap']),
            'domisili'     => trim($validated['domisili']),
            'email'        => strtolower(trim($validated['email'])),
        ]);

        return redirect()
            ->route('home', ['lang' => $lang])
            ->with('visit_registered', true);
    }

    /**
     * GET /visitor-data — paginated list with search.
     */
    public function index(Request $request)
    {
        $lang   = $this->lang($request);
        $t      = config("content.visitor_data.{$lang}");
        $search = trim((string) $request->query('q', ''));

        $query = Visitor::query()->orderByDesc('created_at');
        if ($search !== '') {
            $like = '%' . $search . '%';
            $query->where(function ($q) use ($like) {
                $q->where('nama_lengkap', 'like', $like)
                  ->orWhere('domisili',   'like', $like)
                  ->orWhere('email',      'like', $like);
            });
        }

        $totalAll = Visitor::count();
        $visitors = $query->paginate(10)->withQueryString();

        return view('visitor_data', [
            'lang'     => $lang,
            't'        => $t,
            'visitors' => $visitors,
            'totalAll' => $totalAll,
            'search'   => $search,
        ]);
    }

    /**
     * DELETE /visitor-data — wipe all entries.
     */
    public function destroyAll(Request $request)
    {
        $lang = $this->lang($request);
        Visitor::query()->delete();

        return redirect()->route('visitor.index', ['lang' => $lang]);
    }

    /**
     * GET /visitor-data/export — Excel download of (optionally) filtered data.
     */
    public function export(Request $request): StreamedResponse
    {
        $lang   = $this->lang($request);
        $t      = config("content.visitor_data.{$lang}");
        $search = trim((string) $request->query('q', ''));

        $query = Visitor::query()->orderByDesc('created_at');
        if ($search !== '') {
            $like = '%' . $search . '%';
            $query->where(function ($q) use ($like) {
                $q->where('nama_lengkap', 'like', $like)
                  ->orWhere('domisili',   'like', $like)
                  ->orWhere('email',      'like', $like);
            });
        }
        $rows = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($t['sheetName']);

        // Header row
        $sheet->fromArray([
            'No',
            $t['excelColName'],
            $t['excelColCity'],
            'Email',
            $t['excelColDate'],
        ], null, 'A1');

        $locale = $t['locale'];
        foreach ($rows as $i => $v) {
            $date = Carbon::parse($v->created_at)
                ->locale($locale)
                ->isoFormat('DD MMM YYYY, HH:mm');

            $sheet->fromArray([
                $i + 1,
                $v->nama_lengkap,
                $v->domisili,
                $v->email,
                $date,
            ], null, 'A' . ($i + 2));
        }

        // Column widths matching the React version
        foreach (['A' => 5, 'B' => 30, 'C' => 25, 'D' => 35, 'E' => 25] as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        $stamp    = now()->format('Ymd');
        $filename = "data-pengunjung-nasi-jamblang-{$stamp}.xlsx";

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
