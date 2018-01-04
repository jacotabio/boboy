<?php
include '../library/config.php';
include '../classes/class.products.php';
include '../classes/class.suppliers.php';
include '../classes/class.payments.php';
include '../classes/class.orders.php';
include '../classes/class.delivery.php';
include '../classes/class.clients.php';
include '../classes/class.users.php';
include '../classes/class.reports.php';

$users = new Users();
$suppliers = new Suppliers();
$payments = new Payments();
$orders = new Orders();
$delivery = new Delivery();
$products = new Products();
$clients = new Clients();
$reports = new Reports();

require('../api/fpdf/fpdf.php');


class PDF extends FPDF
{

var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{

    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=(5*$nb)+3; //+3 sa height nya nadi pre
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border

        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
// Page header
function Header()
{
    // Logo
    $this->Image('../img/logo_orig.png',10,3,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(30);
    // Title
    $this->Cell(220,5,'SUNGEM PHARMA',0,0,'C');
    // Line break
    $this->Ln(5);
    // Move to the right
    $this->Cell(30);
    // Line break
    $this->Cell(220,8,'(Sales Report)',0,0,'C');
    // Line break
    $this->Ln(5);
    //ALL VALUES RETRIEVED FROM URL CONVERT
    $start_date = date('F d, Y', strtotime($_GET['start']));
    $end_date = date('F d, Y', strtotime($_GET['end']));
    
    // Move to the right
    $this->Cell(30);
    //SUBTITLE
    $this->SetFont('Arial','',12);
    $this->Cell(220,10, $start_date." - ".$end_date ,0,0,'C');
    // Line break
    $this->Ln(15);
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class above na di pre
$pdf = new PDF();
//TABLE HEADER
//CLASS FUNCTION


$pdf->AliasNbPages();
$pdf->AddPage(L);
$pdf->SetFont('Arial','B',12);
$pdf->ln(1);
$pdf->Cell(280,5,'(MANAGEMENT SALES REPORT)',0,0,'C');
$pdf->ln(8);
$pdf->SetFont('Arial','B',11);
//WIDTH SANG COLUMN
$pdf->SetWidths(array(120,90,60));
//ALIGNMENT SANG COLUMNS
$pdf->SetAligns(array('L','L','C'));
//HEADER
$pdf->Row(array('Client','Area','Received Payment (Collection)'));
$pdf->SetAligns(array('L','L','L'));
$pdf->SetFont('Arial','',11);
$client_list = $clients->get_clients_desc();
  if($client_list){
    foreach($client_list as $client_row){
      $client_amount = $reports->get_client_received_sales($client_row['client_id'],$_GET['start'],$_GET['end']);
      if($client_amount>0){
        $x = $pdf->Row(array($client_row['client_name'],$client_row['area_name'],"P ".number_format($client_amount, 2, '.', ',')));
    }
    }
}
//$pdf->BasicTable($header, $data);
$pdf->Output();
?>