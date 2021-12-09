<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    /**
     * @Route("/export", name="export")
     */
    public function index(): Response
    {
        //Cet exemple est tiré du site tcpdf et ne représente en rien le produit fini, il sert juste à montrer ce que TCPDF peut faire.
        
        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 031');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 031', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Example of PieSector() method.');

        $xc = 105;
        $yc = 100;
        $r = 50;

        $pdf->SetFillColor(0, 0, 255);
        $pdf->PieSector($xc, $yc, $r, 90, 140, 'FD', false, 0, 2);

        $pdf->SetFillColor(0, 255, 0);
        $pdf->PieSector($xc, $yc, $r, 140, 270, 'FD', false, 0, 2);

        $pdf->SetFillColor(255, 0, 0);
        $pdf->PieSector($xc, $yc, $r, 270, 90, 'FD', false, 0, 2);

        // write labels
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(75, 65, 'BLUE');
        $pdf->Text(60, 95, 'GREEN');
        $pdf->Text(120, 115, 'RED');

// ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_031.pdf', 'I');

        // return $this->render('export/index.html.twig', [
        //     'controller_name' => 'ExportController',
        // ]);
    }
}
