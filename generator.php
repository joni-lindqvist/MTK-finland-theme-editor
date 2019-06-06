<!doctype html>
<html lang="fi">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>

        <style>
            .colorpicker-element .add-on i, .colorpicker-element .input-group-addon i{
                width:2rem;
                height:2rem;
                margin-left: 2px;
                border: 1px solid #66666670;
                box-shadow: 0px 0px 10px #333;
            }
        </style>

    </head>
	<body class="p-1">
    <div class="container-fluid">


<?php
/**
 * Created by PhpStorm.
 * User: joni
 * Date: 13/05/2019
 * Time: 21.10
 */


$trans = array(
	"4A"=>"Polku / Ajopolku",
	"1A"=>"Moottoritie (Ia)",
	"1B"=>"Moottoriliikennetie tai vastaava (Ib)",
	"2A"=>"Valtatie (IIa)",
	"2B"=>"Valtatie (IIb)",
	"3A"=>"Valtatie (IIIa)",
	"3B"=>"Valtatie (IIIb)",
	"SR"=>"Pikkutie/yksityistie",
	"WR"=>"Talvitie",
	"RB"=>"Asuinrakennus",
	"PB"=>"Julkinen rakennus",
	"VB"=>"Loma-asunto",
	"IB"=>"Teollisuusrakennus/kirkko",
	"OB"=>"Muu rakennus (ulkorakennus/lato)",
	"PL"=>"Suurjännitelinja",
	"UP1"=>"( päällystämätön luokka 1)",
	"UP0"=>"( päällystämätön luokka 0)",
	''=>'' // null check

);

$file = file_get_contents('Peruskartta_v3.template.xml' );

$matches = [];

preg_match_all('/{(.*?)}/im', $file, $matches);

$all_tags = array_unique( $matches[1] );

?>
<h1>MTK - suomi teemaeditori</h1>
<form>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Kohteen tyyppi</th>
            <th scope="col">Tarkennus</th>
            <th scope="col">Valitsin</th>
        </tr>
    </thead>
    <tbody>
<?php


foreach ($all_tags as $val){
	echo "<tr>";
	$parts = explode('_', $val);

	//$x[] = '"'.$parts[0].'"=>"",'."\n"; continue;

	echo "<td>".$trans[$parts[0]]." ".$trans[($parts[2]??'')]."</td>";

	echo "</rule>\n<rule e=\"way\" k=\"kohdeluokka\" v=\"12313\" zoom-min=\"{4A_ZL}\"> <!-- musta -->\n<line stroke=\"{4A_EC}\" stroke-width=\"{4A_EW}\" stroke-dasharray=\"4,2\" stroke-linecap=\"butt\"/>";


	switch( $parts[1] ){
		case 'EW': echo "<td>Piirron leveys</td><td><input class='form-control' type='number' min='0' max='10' step='0.1' value=1 name='$val'></td>";break;
		case 'FW': echo "<td>Täytön leveys</td> <td><input class='form-control' type='number' min='0' max='10' step='0.1' value=0.8  name='$val'></td>";break;
		case 'FC': echo "<td>Täytön väri</td> 
                         <td class='color-pick'><div class='input-group colorpicker-component'>
                                <input type='text' value='#ff0000' class='form-control' name='$val'/>
                                <span class='input-group-addon'><i></i></span>
                            </div></td>";break;
		case 'EC': echo "<td>Reunan väri</td> 
                          <td class='color-pick'>
                          <div class='input-group colorpicker-component'>
                                <input type='text' value='#000' class='form-control' name='$val'/>
                                <span class='input-group-addon'><i></i></span>
                            </div></td>";break;
		case 'ZL': echo "<td><a href = 'https://wiki.openstreetmap.org/wiki/Zoom_levels'>Min Zoom level</a></td> <td><input class='form-control' type='number' min='0' max='19' step='1' value=12 name='$val'></td>";break;

	}

	echo "</tr>\n";
}
echo "</tbody>";
//$x = array_unique($x);
echo "</table></form>";
//foreach ($x as $val ) echo $val.""; exit;
echo "<div class='text-right'>";
echo "<a href='' id='download' style='display:none' class='btn btn-dark mr-3'>Lataa tiedosto</a>";
echo "<button id='generate' class='btn btn-dark mr-3'>Generoi teema</button>";

?>

<?php

echo "</div>\n";
?>
    </div>




    <script>
	var data = [];

	$('.color-pick div').colorpicker({format: 'hex'});

	$('#generate').click( function(){
	   $.each( $('input'), function(key, input){
	       var $input = $(input);

	       data.push({ name: $input.attr('name'), value: $input.val()});




	   });

       var template;

       fetch('https://joni-lindqvist.github.io/MTK-finland-theme-editor/Peruskartta_v3.template.xml')
            .then(response => response.text())
            .then(text => template_substitute(text, data));


	});

	function template_substitute( template, data){
	    var parsed = template;

	    $.each( data, function( key, val){
            var regex = new RegExp('{'+val.name+'}', 'g');
	        parsed = parsed.replace(regex, val.value);
        });

	    var a = jQuery('#download');

        a.fadeIn('quick');

        a=a[0];

        console.log( parsed );

        var file = new Blob([parsed], {type: 'application/xml'});
        a.href = URL.createObjectURL(file);
        a.download = 'Peruskartta_v3.xml';

    }
</script>

	</body>

</html>