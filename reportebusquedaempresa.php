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
        $this->Text($xpos, $ypos + $height + 4, $code);
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
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            if($col == "ENTIDAD"){
                $this->Cell(60,5,$col,1);
            }else{
                if($col == "CORREO"){
                    $this->Cell(25,5,$col,1);
                }else{
                    if($col == "NIT" or $col == "MATRICULA" or $col == "TELEFONO"){
                        $this->Cell(14,5,$col,1);
                    }else{
                        $this->Cell(18,5,$col,1);
                    }
                }
            }
            
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            $columna = 1;
            foreach($row as $col){
                if($columna == 1){
                    $columna++;
                    $this->Cell(60,3,$col,1);
                }else{
                    if($columna == 5){
                        $this->Cell(25,3,$col,1);    
                    }else{
                        if($columna == 2 OR $columna == 3 OR $columna == 4){
                            $this->Cell(14,3,$col,1);        
                        }else{
                            $this->Cell(18,3,$col,1);        
                        }
                    }
                    $columna++;
                }
            }    
            $this->Ln();
        }
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

if (isset($_GET['monto']) and isset($_GET['iddepto'])) 
//if()
{
    $resultado = $_GET['resp'];
    $monto = $_GET['monto'];
    $iddepto = $_GET['iddepto'];
    $monto = str_replace('p', '.', $monto);
    $montodato = number_format($monto,2)." Bs.";
    $user = $_GET['user'];
    if($iddepto == 2){
        $departamento = "La Paz";
    }
    if($iddepto == 1){
        $departamento = "Chuquisaca";
    }
    if($iddepto == 3){
        $departamento = "Cochabamba";
    }
    if($iddepto == 4){
        $departamento = "Oruro";
    }
    if($iddepto == 5){
        $departamento = "Potosi";
    }
    if($iddepto == 6){
        $departamento = "Tarija";
    }
    if($iddepto == 7){
        $departamento = "Santa Cruz";
    }
    if($iddepto == 8){
        $departamento = "Beni";
    }
    if($iddepto == 9){
        $departamento = "Pando";
    }
    if($iddepto == "-1"){
        $departamento = "SIN DEPARTAMENTO";
    }
    //$id = 44282;    
    //conexion a la base de datos    
    //$dbh = new PDO('mysql:host=localhost;port=3306;dbname=cuadro', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
    $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
    
    $sqlpar1 = "SELECT dato1,dato2 from busquedaempresaparametros where parametro = 'monto_exp' and activo = 'SI' LIMIT 0,1";
    $stmt = $dbh->prepare($sqlpar1);
    $stmt->execute();
    $regpar1 = $stmt->fetch(PDO::FETCH_ASSOC);
    $dato11 = $regpar1['dato1'];
    $dato12 = $regpar1['dato2'];
    $sqlpar = "SELECT dato1 from busquedaempresaparametros where parametro = 'anios_exp' and activo = 'SI' order by id desc LIMIT 0,1";
    $stmt = $dbh->prepare($sqlpar);
    $stmt->execute();
    $regpar = $stmt->fetch(PDO::FETCH_ASSOC);
    if(empty($regpar['dato1'])){
        $dato = 100;
        $anios = '';
    }else{
        $dato = $regpar['dato1'];
        $anios = $dato;
    }
    $date = date('Y');
    $date10 = ($date-$dato)."-01-01";
    $criterios = 'EMPRESAS:::MONTO:'.$monto.'||DEPTO:'.$departamento.'||ANIOS:'.$anios.'||RELACION EXP G:ESP('.$dato11.':'.$dato12.')';
    $insert = "INSERT INTO historybusqueda (`user`,`criterios`,`resultado`) VALUES ('$user','$criterios','$resultado')";
    $stmt = $dbh->prepare($insert);
    $stmt->execute();
    $sqlidh = "SELECT id from historybusqueda where user = '$user' order by id DESC limit 0,1";
    $stmt = $dbh->prepare($sqlidh);
    $stmt->execute();
    $regid = $stmt->fetch(PDO::FETCH_ASSOC);
    $idh = $regid['id'];
    $codi = $idh+234;
    $codigo = 'AB'.$codi.'XY';
    if($monto == 0 and $iddepto != "-1"){
        $sql = "SELECT empresas.id, empresas.nombre_proponente, empresas.nit, empresas.matricula, empresas.celular, empresas.mail, 
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.fecha_ini_contrato >= '$date10') as montog, 
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1 and experienciaentidad.fecha_ini_contrato >= '$date10') as montoesp,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id) as tiempomeses,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1) as tiempomesesp 
FROM departamentosinteres INNER JOIN empresas ON departamentosinteres.id_empresas = empresas.id
where empresas.estado = 4 and empresas.tipo <> 9 and empresas.tipo <> 19 and departamentosinteres.id_departamentos = $iddepto group by empresas.id order by montog DESC";
    }
    if($iddepto == "-1" and $monto != 0){
        $sql = "SELECT * FROM (SELECT experienciaentidad.id_entidad as 'id', 
            SUM(experienciaentidad.monto_contrato) as monto, empresas.nombre_proponente, empresas.nit, empresas.matricula, empresas.celular, empresas.mail,
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.fecha_ini_contrato >= '$date10') as montog, 
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1 and experienciaentidad.fecha_ini_contrato >= '$date10') as montoesp,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id) as tiempomeses,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1) as tiempomesesp 
        FROM experienciaentidad INNER JOIN empresas ON experienciaentidad.id_entidad = empresas.id
        where empresas.estado = 4 and empresas.tipo <> 9 and empresas.tipo <> 19 group by experienciaentidad.id_entidad) as tb1 where tb1.montog >= ($monto*(SELECT dato1 from busquedaempresaparametros where parametro = 'monto_exp' and activo = 'SI' LIMIT 0,1)) and 
tb1.montoesp >= ($monto*(SELECT dato2 from busquedaempresaparametros where parametro = 'monto_exp' and activo = 'SI' LIMIT 0,1)) order by tb1.montog DESC";
    }
    if($monto != 0 and $iddepto != "-1"){
        /*
        $sql = "SELECT * from (SELECT experienciaentidad.id_entidad as 'id', 
            SUM(experienciaentidad.monto_contrato) as monto, empresas.nombre_proponente, empresas.nit, empresas.matricula, empresas.celular, empresas.mail,
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id) as montog, 
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1) as montoesp,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id) as tiempomeses 
        FROM experienciaentidad INNER JOIN empresas ON experienciaentidad.id_entidad = empresas.id
        where empresas.estado = 4 and empresas.tipo <> 9 and empresas.tipo <> 19 group by experienciaentidad.id_entidad) as tb 
        INNER JOIN departamentosinteres on tb.id = departamentosinteres.id_empresas
        where departamentosinteres.id_departamentos = $iddepto and tb.monto >= $monto";
        */
        $sql = "SELECT * from (SELECT experienciaentidad.id_entidad as 'id', 
            SUM(experienciaentidad.monto_contrato) as monto, empresas.nombre_proponente, empresas.nit, empresas.matricula, empresas.celular, empresas.mail,
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.fecha_ini_contrato >= '$date10') as montog, 
(SELECT SUM(experienciaentidad.monto_contrato) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1 and experienciaentidad.fecha_ini_contrato >= '$date10') as montoesp,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id) as tiempomeses,
(SELECT SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2)) FROM experienciaentidad where experienciaentidad.id_entidad = empresas.id and experienciaentidad.tipo = 1) as tiempomesesp 
        FROM experienciaentidad INNER JOIN empresas ON experienciaentidad.id_entidad = empresas.id
        where empresas.estado = 4 and empresas.tipo <> 9 and empresas.tipo <> 19 group by experienciaentidad.id_entidad) as tb 
        INNER JOIN departamentosinteres on tb.id = departamentosinteres.id_empresas
        where departamentosinteres.id_departamentos = $iddepto and tb.montog >= ($monto*(SELECT dato1 from busquedaempresaparametros where parametro = 'monto_exp' and activo = 'SI' LIMIT 0,1)) and 
tb.montoesp >= ($monto*(SELECT dato2 from busquedaempresaparametros where parametro = 'monto_exp' and activo = 'SI' LIMIT 0,1)) order by tb.montog DESC";
    }
    
        $pdf = new PDF('P', 'mm', 'Letter');
        $pdf->SetMargins(15, 10, 5);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Ln(5);
        $pdf->Cell(195, 5, utf8_decode('REGISTRO DE BUSQUEDA DE EMPRESAS'), 0, FALSE, 'C');
        $pdf->Ln(4);
        $pdf->SetFont('helvetica', '', 10);
        $date = date('Y-m-d H:i:s');
        $pdf->Cell(195, 5, utf8_decode('USUARIO: ').$user, 0, FALSE, 'C');
        $pdf->Ln(3);
        $pdf->Cell(195, 6, utf8_decode('CRITERIOS DE BUSQUEDA'), 0, FALSE, 'C');
        $pdf->Ln(3);
        $pdf->Cell(195, 7, utf8_decode('MONTO DEL PROYECTO: ').$montodato, 0, FALSE, 'C');
        $pdf->Ln(3);
        $pdf->Cell(195, 8, utf8_decode('UBICACION DEL PROYECTO: ').$departamento, 0, FALSE, 'C');
        $pdf->Ln(4);
        $pdf->Cell(195, 8, utf8_decode('DATOS TOMADOS DE LOS ').$anios.utf8_decode(' ULTIMOS AÑOS DE EXPERIENCIA') , 0, FALSE, 'C');
        $pdf->Ln(4);
        $pdf->Cell(195, 8, utf8_decode('RELACION EXPERIENCIA GENERAL : ESPECIFICA (').$dato11.':'.$dato12.')' , 0, FALSE, 'C');
        $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10, 20, 5, 10', 'phase' => 30, 'color' => array(255, 0, 0));
        $pdf->Ln(3);
        $pdf->Line(15, 60, 195, 60, $style);
        $pdf->Ln(10);
        $pdf->SetWidths(array(10,120));
        $pdf->SetAligns(array('L','L'));
        //$pdf->Row(array());
        $pdf->SetFont('helvetica', '', 8);
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = array();
        $cont=0;
        $header = array('ENTIDAD','NIT','MATRICULA','TELEFONO','CORREO','MONTO_GEN','MONTO_ESP','TIEMPO_GEN','TIEMPO_ESP');
        while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
            //$data[] = array($rs[nombre_proponente],$rs[nit],$rs[matricula],$rs[celular],$rs[mail],$rs[montog],$rs[montoesp],$rs[tiempomeses]);
            $entidad = $rs['nombre_proponente'];
            $nit = $rs['nit'];
            $matricula = $rs['matricula'];
            $telefono = $rs['celular'];
            $correo = $rs['mail'];
            $montog = number_format($rs['montog'],2);
            $montoesp = number_format($rs['montoesp'],2);
            $tiempo = $rs['tiempomeses']."(meses)";
            $tiempoesp = $rs['tiempomesesp']."(meses)";
            $data[] = array($entidad,$nit,$matricula,$telefono,$correo,$montog,$montoesp,$tiempo,$tiempoesp);
            $cont++;
        }
        $pdf->SetFont('Arial','',5);
        $pdf->BasicTable($header,$data);
        
        
        


        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(180, 12, utf8_decode('ESTA INFORMACION ESTA SIENDO ASOCIADA A SU USUARIO.'), 0, FALSE, 'C');
        $pdf->Ln(20);
        
        

       //codigo de barras____________________
        $pdf->SetX(35);
        $pdf->Sety(135);
        $pdf->Cell(140, 25, '', 0, FALSE, 'R');
        $pdf->Code39(140, 250, $codigo, 1, 8);

        $pdf->Output('BUSQUEDA_' . $user . '.pdf', 'D');
   
}

function fecha($fecha = '') {
    if (strlen($fecha) > 0) {
        return date('d/m/Y', strtotime($fecha));
    } else {
        return '-';
    }
}

?>
