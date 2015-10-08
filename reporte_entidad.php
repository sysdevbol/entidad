<?php

/* REPORTE POR PROYECTO
 * by Ivan Chacolla M.
 * JEFE DE UNIDAD DE SISTEMAS
 * AEVIVIENDA
 */
require ('application/vendor/fpdf17/fpdf.php');

class PDF extends FPDF {

    var $widths;
    var $aligns;

    function Header() {
        //Logo
        $this->Image('media/img/escudo.png', 10, 8, 22);
        //Arial bold 15
        $this->SetFont('Arial', '', 9);
        //Move to the right
        $this->Cell(55);
        //Title
        $this->Cell(90, 5, 'Estado Plurinacional de Bolivia', 0, 0, 'C');
        $this->Image('media/img/logo2.png', 175, 8, 25);
        $this->Ln(3);
        $this->SetFont('Arial', '', 6);
        $this->Cell(73);
        $this->Cell(55, 5, 'Ministerio de Obras Publicas, Servicios y Vivienda', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(55);
        $this->SetFont('Arial', '', 5);
        $this->Cell(90, 5, 'AGENCIA ESTATAL DE VIVIENDA', 0, 0, 'C');
        //Line break
        $this->Ln(10);
    }

    //Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 7);
        //Page number        
        // $this->Image('assets/img/quinua.png', 140, 258, 60);
        $this->Cell(195, 5, 'Fecha: ' . date('d/m/Y'), 0, 0, 'L');
        $this->Ln();
        $this->Cell(195, 5, utf8_decode('Calle Fernando Guachalla No. 411 esquina Av. 20 de Octubre TÃ©lefonos: 2147707 - 2149962 - 2148743 - 2117569 - 2148747  Fax: 2148743 - www.aevivienda.gob.bo'), 'T', 0, 'C');
    }
    function Code39($xpos, $ypos, $code, $baseline = 0.5, $height = 5) {

        $wide = $baseline;
        $narrow = $baseline / 3;
        $gap = $narrow;

        $barChar['0'] = 'nnnwwnwnn';
        $barChar['1'] = 'wnnwnnnnw';
        $barChar['2'] = 'nnwwnnnnw';
        $barChar['3'] = 'wnwwnnnnn';
        $barChar['4'] = 'nnnwwnnnw';
        $barChar['5'] = 'wnnwwnnnn';
        $barChar['6'] = 'nnwwwnnnn';
        $barChar['7'] = 'nnnwnnwnw';
        $barChar['8'] = 'wnnwnnwnn';
        $barChar['9'] = 'nnwwnnwnn';
        $barChar['A'] = 'wnnnnwnnw';
        $barChar['B'] = 'nnwnnwnnw';
        $barChar['C'] = 'wnwnnwnnn';
        $barChar['D'] = 'nnnnwwnnw';
        $barChar['E'] = 'wnnnwwnnn';
        $barChar['F'] = 'nnwnwwnnn';
        $barChar['G'] = 'nnnnnwwnw';
        $barChar['H'] = 'wnnnnwwnn';
        $barChar['I'] = 'nnwnnwwnn';
        $barChar['J'] = 'nnnnwwwnn';
        $barChar['K'] = 'wnnnnnnww';
        $barChar['L'] = 'nnwnnnnww';
        $barChar['M'] = 'wnwnnnnwn';
        $barChar['N'] = 'nnnnwnnww';
        $barChar['O'] = 'wnnnwnnwn';
        $barChar['P'] = 'nnwnwnnwn';
        $barChar['Q'] = 'nnnnnnwww';
        $barChar['R'] = 'wnnnnnwwn';
        $barChar['S'] = 'nnwnnnwwn';
        $barChar['T'] = 'nnnnwnwwn';
        $barChar['U'] = 'wwnnnnnnw';
        $barChar['V'] = 'nwwnnnnnw';
        $barChar['W'] = 'wwwnnnnnn';
        $barChar['X'] = 'nwnnwnnnw';
        $barChar['Y'] = 'wwnnwnnnn';
        $barChar['Z'] = 'nwwnwnnnn';
        $barChar['-'] = 'nwnnnnwnw';
        $barChar['.'] = 'wwnnnnwnn';
        $barChar[' '] = 'nwwnnnwnn';
        $barChar['*'] = 'nwnnwnwnn';
        $barChar['$'] = 'nwnwnwnnn';
        $barChar['/'] = 'nwnwnnnwn';
        $barChar['+'] = 'nwnnnwnwn';
        $barChar['%'] = 'nnnwnwnwn';

        $this->SetFont('Arial', '', 10);
        //$this->Text($xpos, $ypos + $height + 4, $code);
        $this->SetFillColor(0);

        $code = '*' . strtoupper($code) . '*';
        for ($i = 0; $i < strlen($code); $i++) {
            $char = $code[$i];
            if (!isset($barChar[$char])) {
                $this->Error('Invalid character in barcode: ' . $char);
            }
            $seq = $barChar[$char];
            for ($bar = 0; $bar < 9; $bar++) {
                if ($seq[$bar] == 'n') {
                    $lineWidth = $narrow;
                } else {
                    $lineWidth = $wide;
                }
                if ($bar % 2 == 0) {
                    $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
                }
                $xpos += $lineWidth;
            }
            $xpos += $gap;
        }
    }
    function SetWidths($w) {
        //Set the array of column widths 
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments 
        $this->aligns = $a;
    }

    function fill($f) {
        //juego de arreglos de relleno
        $this->fill = $f;
    }

    function Row($data) {
        //Calculate the height of the row 
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            $this->Rect($x, $y, $w, $h);
            //Print the text 
            //$this->MultiCell($w, 5, $data[$i], 'LTR', $a);
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line 
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately 
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take 
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

}

if (isset($_GET['ide'])) 
//if()
{
    $id = $_GET['ide'];    
    //$id = 44282;    
    //conexion a la base de datos    
    //$dbh = new PDO('mysql:host=localhost;port=3306;dbname=cuadro', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
    $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));

    $sql = "SELECT *, DATE_FORMAT(fecha_insert,'%d/%m/%Y %H:%i:%s') as fecharegistro
            FROM empresas
            WHERE id=$id";
            
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        $pdf = new PDF('P', 'mm', 'Letter');
        $pdf->SetMargins(15, 10, 5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Ln(5);
        $pdf->Cell(195, 5, utf8_decode('CERTIFICADO DE HABILITACIÓN'), 0, FALSE, 'C');
        $pdf->Ln(4);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(195, 5, utf8_decode('CODIGO: ').$rs->pin_empresa, 0, FALSE, 'C');
        $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10, 20, 5, 10', 'phase' => 30, 'color' => array(255, 0, 0));
        $pdf->Line(15, 45, 195, 45, $style);
        $pdf->Ln(10);
        $pdf->SetWidths(array(60,120));
        $pdf->SetAligns(array('L','L'));
        //$pdf->Row(array());
        $pdf->MultiCell(180, 5, utf8_decode("El presente documento certifica la habilitación a la Empresa ".strtoupper($rs->nombre_proponente).". Representada por el Sr(a). ".strtoupper($rs->nombres_representante)." ".strtoupper($rs->paterno_representante)." ".strtoupper($rs->materno_representante)." para la participación en distintos proyectos dependientes de la Agencia Estatal de Vivienda, con todos los derechos y que ello conlleva."), 0, 'J');
        $pdf->Ln(10);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Row(array('ENTIDAD EJECUTORA',strtoupper($rs->nombre_proponente)));
        $pdf->Row(array('NOMBRE DEL REPRESENTANTE LEGAL',strtoupper($rs->nombres_representante)." ".strtoupper($rs->paterno_representante)." ".strtoupper($rs->materno_representante)));
        $pdf->Row(array('NIT',$rs->nit));
        $pdf->Row(array('FUNDAEMPRESA',$rs->matricula));
        $pdf->Row(array('DOMICILIO LEGAL',$rs->direccion));
        $pdf->Row(array('TELEFONO/CELULAR',$rs->telefonos." / ".$rs->celular));
        $pdf->Row(array(utf8_decode('CORREO ELECTRÓNICO'),$rs->mail));
        $pdf->Row(array('FECHA DE REGISTRO',$rs->fecharegistro));
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(180, 12, utf8_decode('Toda la información ingresada en el presente registro tiene validez de DECLARACION JURADA y tendrá el tratamiento legal correspondiente.'), 0, FALSE, 'C');
        $pdf->Ln(20);
        $pdf->Cell(60);
        $pdf->Cell(60, 40,'', 1, FALSE, 'C');
        $pdf->Ln();
        $pdf->Cell(60);
        $pdf->Cell(60, 10,'FIRMA Y SELLO TECNICO LEGAL', 1, FALSE, 'C');
        
        
        
        
        
        
        
        /*
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(195, 5, 'LISTA DE BENEFICIARIOS', 0, FALSE, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Ln(5);
        //$pdf->Cell(195, 4, 'Reporte de Impresion: '.date('d/m/Y H:m:i',strtotime($rs->fecha_update)), 0, FALSE, 'C');        
        $pdf->Cell(30, 5, 'PROYECTO: ', 1, FALSE, 'L');        
        $pdf->Cell(165, 5, $rs->proyecto_nombre, 1, FALSE, 'L');        

 
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(30, 5, utf8_decode('CODIGO SAP:'), 1, FALSE, 'R');        
        $pdf->Cell(40, 5, utf8_decode($rs->codigo_sap), 1, FALSE, 'C');
        $pdf->Cell(30, 5, 'DEPARTAMENTO: ', 1, FALSE, 'R');        
        $pdf->Cell(60, 5, $rs->depto, 1, FALSE, 'C');        
        $pdf->Cell(15, 5, 'SH: ', 1, FALSE, 'R');        
        $pdf->Cell(20, 5, $rs->uh_proy, 1, FALSE, 'C');        
        $pdf->Ln(5);
        
         //------------------- consultas para buscar el almacenero del proyecto
	     
	     $sqlx="SELECT * 
					FROM stscmiuser a
					INNER JOIN users b on a.id_user = b.id
					where a.id_cmi= $id";
        $stmtx = $dbh->prepare($sqlx);
        $stmtx->execute();
        while ($x = $stmtx->fetch(PDO::FETCH_OBJ)){        
	        $pdf->SetFont('Arial', '', 7);
	        $pdf->Cell(30, 5, 'ALMACENERO:', 1, FALSE, 'C');
	        $pdf->Cell(80, 5, utf8_decode($x->nombre), 1, FALSE, 'C');
	        $pdf->Cell(25, 5, 'COMUNIDAD:', 1, FALSE, 'C');
	        $pdf->Cell(60, 5, utf8_decode($x->almacen), 1, FALSE, 'C');
	        $pdf->Ln();
        }
		  $pdf->Ln(10);       
        
	     //_______________mostrar la cantidad total de insumos del cada proyecto

        $sql1 = "SELECT a.*, b.departamento, c.tipo
					FROM stsbeneficiario a
					INNER JOIN departamentos b ON b.id = a. extension_ci
					INNER JOIN tipo c ON c.id = a.tipo_doc
					where a.id_proyecto = $id
					";
        $stmt2 = $dbh->prepare($sql1);
        $stmt2->execute();
	   
        $pdf->SetFont('Arial', 'B', 7);       
        $pdf->Cell(8, 5, utf8_decode('NÂº'), 1, FALSE, 'C');
        $pdf->Cell(32, 5, utf8_decode('COMUNIDAD'), 1, FALSE, 'C');
        $pdf->Cell(25, 5, utf8_decode('1er APELLIDO'), 1, FALSE, 'C');
        $pdf->Cell(25, 5, utf8_decode('2do APELLIDO'), 1, FALSE, 'C');
        $pdf->Cell(25, 5, utf8_decode('APELLIDO ESP.'), 1, FALSE, 'C');
        $pdf->Cell(30, 5, utf8_decode('NOMBRES'), 1, FALSE, 'C');
        $pdf->Cell(20, 5, utf8_decode('CI'), 1, FALSE, 'C');
        $pdf->Cell(30, 5, utf8_decode('OCUPACION'), 1, FALSE, 'C');
        /*$pdf->Cell(25, 5, utf8_decode('NÂº FACTURA'), 1, FALSE, 'C');
        $pdf->Cell(25, 5, utf8_decode('SALDO'), 1, FALSE, 'C');
        $pdf->Ln();
        //$x = $pdf->GetX();
        //$y = $pdf->GetY();
        $i = 1;

        $pdf->SetWidths(array(8,32,25,25,25,30,20,30));        
        $pdf->SetAligns(array('L','L','L','L','L','L','L','L'));
        $pdf->SetFont('Arial', '', 6);

        while ($c = $stmt2->fetch(PDO::FETCH_OBJ)) {
            //$pdf->SetXY(10, $y);
            //$pdf->Cell(65, 5, $c->articulo, 'LR', FALSE, 'L');            
            //$pdf->Ln(); 
            $pdf->Row(array(  
                        utf8_decode($i),
                        utf8_decode($c->comunidad),
                        utf8_decode($c->paterno),
                        utf8_decode($c->materno),
                        utf8_decode($c->apellido_especial),
                        utf8_decode($c->nombres),
                        utf8_decode($c->num_doc),
                        utf8_decode($c->ocupacion),
                        ));                                
                    $i++;               
        }
	    //$pdf->Ln();
       // $pdf->Cell(165, 5, utf8_decode('TOTAL Bs.'), 0, FALSE, 'R');
	    $sql2=" SELECT *, SUM(cantidad * precio) as total
					FROM stsitems
					where id_proyecto = $id";
        $stmt3 = $dbh->prepare($sql2);
        $stmt3->execute();        
        
        $d = $stmt3->fetch(PDO::FETCH_OBJ);
        //$pdf->Cell(30, 5, number_format($d->total,2,',','.'), 1, FALSE, 'C');

        */

       //codigo de barras____________________
        $pdf->SetX(35);
        $pdf->Sety(135);
        $pdf->Cell(155, 25, '', 0, FALSE, 'R');
        $pdf->Code39(155, 250, $rs->pin_empresa, 1, 8);

        $pdf->Output('entidad' . $rs->pin_empresa . '.pdf', 'D');
    }
}

function fecha($fecha = '') {
    if (strlen($fecha) > 0) {
        return date('d/m/Y', strtotime($fecha));
    } else {
        return '-';
    }
}

?>
