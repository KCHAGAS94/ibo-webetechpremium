<?php $IIIIIIIIIl11 = file_get_contents('./includes/eggzie.json');
$IIIIIIIII1II = json_decode($IIIIIIIIIl11,true);
$IIIIIIIII1Il = $IIIIIIIII1II['info'];
$IIIIIIIIlI11 = $IIIIIIIII1Il['aa'];
$IIIIIIIII1ll = ($IIIIIIIII1Il['aa'] == '1'?'selected': '');
$IIIIIIIIllII = ($IIIIIIIII1Il['aa'] == '2'?'selected': '');
$IIIIIIIIllIl = ($IIIIIIIII1Il['aa'] == '3'?'selected': '');
$IIIIIIIIllI1 = ($IIIIIIIII1Il['aa'] == '4'?'selected': '');
$IIIIIIIIlllI = ($IIIIIIIII1Il['aa'] == '5'?'selected': '');
$IIIIIIIIllll = ($IIIIIIIII1Il['aa'] == '6'?'selected': '');
$IIIIIIIIlll1 = ($IIIIIIIII1Il['aa'] == '7'?'selected': '');
$IIIIIIIIll1I = ($IIIIIIIII1Il['aa'] == '8'?'selected': '');
$IIIIIIIIll1l = ($IIIIIIIII1Il['aa'] == '9'?'selected': '');
$IIIIIIIIll11 = ($IIIIIIIII1Il['aa'] == '11'?'selected': '');
$IIIIIIIIl1II = ($IIIIIIIII1Il['aa'] == '12'?'selected': '');
$IIIIIIIIl1Il = ($IIIIIIIII1Il['aa'] == '13'?'selected': '');
$IIIIIIIIl1I1 = ($IIIIIIIII1Il['aa'] == '14'?'selected': '');
$IIIIIIIIl1lI = ($IIIIIIIII1Il['aa'] == '15'?'selected': '');
$IIIIIIIIl1ll = '<div class="alert alert-primary" id="flash-msg"><h4><i class="icon fa fa-check"></i>Theme Updated!</h4></div>';
if (isset($_POST['submit'])) {
$IIIIIIIIl1l1 = file_get_contents('./includes/eggzie.json');
$date = date('d-m-Y H:i:s');
$IIIIIIIIl11I = time();
$IIIIIIIIl111 = base64_encode($date);
$IIIIIIII1IIl = sha1($IIIIIIIIl111);
$IIIIIIII1IlI = $IIIIIIIII1Il['ii'] +1;
$IIIIIIII1Ill = json_decode($IIIIIIIIl1l1,true);
$IIIIIIII1Il1 = [
'info'=>['aa'=>$_POST['aa'],'bb'=>$date,'cc'=>$IIIIIIIIl11I,'dd'=>$IIIIIIIIl111,'ff'=>$IIIIIIII1IlI,'gg'=>$IIIIIIII1IIl]
];
$IIIIIIII1I1I = array_replace_recursive($IIIIIIII1Ill,$IIIIIIII1Il1);
$IIIIIIII1I1l = json_encode($IIIIIIII1I1I,JSON_UNESCAPED_UNICODE);
file_put_contents('./includes/eggzie.json',$IIIIIIII1I1l);
header('Location: colour.php?m='.$IIIIIIIIl1ll);
}
include 'includes/header.php';
echo ' <!-- Begin Page Content -->'."
";
echo '        <div class="container-fluid">'."
";
echo "
";
if (isset($_GET['m'])) {
echo $_GET['m'];
}
echo '          <!-- Page Heading -->'."
";
echo '          <h1 class="h3 mb-1 text-gray-800">Trocar as Cores</h1>'."
";
echo '         '."
";
echo '          <!-- Content Row -->'."
";
echo '          <div class="row">'."
";
echo "
";
echo '            <!-- First Column -->'."
";
echo '            <div class="col-lg-12">'."
";
echo "
";
echo '              <!-- Custom codes -->'."
";
echo '                <div class="card border-left-primary shadow h-100 card shadow mb-4">'."
";
echo '                <div class="card-header py-3">'."
";
echo '                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-paintbrush"></i> Cores</h6>'."
";
echo '                </div>'."
";
echo '                <div class="card-body">'."
";
echo '                            <form method="post">'."
";
echo "							".'<div class="form-group ">'."
";
echo '                            <label class="control-label requiredField" for="aa" >'."
";
echo '                            <strong> Selecionar Cor</strong>'."
";
echo '                            </label>'."
";
echo '                            <select class="select form-control text-primary" id="select" name="aa">'."
";
echo "								".'<option value="1"'.$IIIIIIIII1ll .'>Roxa</option>'."
";
echo '                                <option value="2"'.$IIIIIIIIllII .'>Azul</option>'."
";
echo "								".'<option value="3"'.$IIIIIIIIllIl .'>Vermelho</option>'."
";
echo "								".'<option value="4"'.$IIIIIIIIllI1 .'>Laranja</option>'."
";
echo "								".'<option value="13"'.$IIIIIIIIl1Il .'>Amarelo</option>'."
";
echo "								".'<option value="5" '.$IIIIIIIIlllI .'>Verde</option>'."
";
echo '                                <option value="6"'.$IIIIIIIIllll .'>Verde-Água</option>'."
";
echo '                                <option value="7"'.$IIIIIIIIlll1 .'>Ciano</option>'."
";
echo "								".'<option value="8"'.$IIIIIIIIll1I .'>Cinza</option>'."
";
echo "								".'<option value="9"'.$IIIIIIIIll1l .'>Cinza-Escuro</option>'."
";
echo "								".'<option value="14"'.$IIIIIIIIl1I1 .'>Preto</option>'."
";
echo "								".'<option value="15"'.$IIIIIIIIl1lI .'>Cinza Escuro - Com Preto</option>'."
";
echo "								".'<option value="11"'.$IIIIIIIIll11 .'>Preto e Branco</option>'."
";
echo "								".'<option value="12"'.$IIIIIIIIl1II .'>Roxo e Branco</option>'."
";
echo '                            </select>'."
";
echo "							".'</div>'."
";
echo '                        <button class="btn btn-success btn-icon-split" name="submit" type="submit">'."
";
echo '                        <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Salvar</span>'."
";
echo '                        </button>'."
";
echo '              </div>'."
";
echo '            </div>'."
";
echo '            </div>'."
";
echo '            </div>'."
";
echo '            </div>'."
";
echo "
";
echo '    <br><br><br>';
include 'includes/footer.php';
require 'includes/egz.php';
echo '</body>'."
";