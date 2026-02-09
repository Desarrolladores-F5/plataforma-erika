<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificadoController extends Controller
{
    /**
     * Descargar certificado de aprobación
     */
    public function descargar(Course $course)
    {
        $user = Auth::user();

        // V1: asumimos que el curso ya fue completado
        $pdf = Pdf::loadView('certificados.certificado', [
            'user'   => $user,
            'course' => $course,
        ])->setPaper('a4', 'portrait');

        $fileName = 'Certificado_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $course->title) . '.pdf';

        return $pdf->download($fileName);
    }
}
