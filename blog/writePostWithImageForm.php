<!DOCTYPE html>
<html>
<head>
<title>Write API</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<!-- <form name="postWriteFrm" id="postWriteFrm" method="POST" action="writePostWithImage.php" target="writeFrmGen" enctype="multipart/form-data"> -->
<form name="postWriteFrm" id="postWriteFrm" method="POST" action="write.php" target="writeFrmGen" enctype="multipart/form-data">
<input type="submit" value="submit"/><br/>

<div data-role="fieldcontain">
<label>blogId </label>
<input type="text" name="blogId" value="erm00" />
</div>

<div data-role="fieldcontain">
<label>title </label>
<input type="text" name="title" value="This is post title " />
</div>

<div data-role="fieldcontain">
<label>contents </label>
<textarea name="contents" style="width:700px; height:500px;">
<p>풀밭에 황금시대의 원질이 끓는 피다. 길을 우리의 우리의 피고 품에 가는 그들의 실현에 것이다.
보이는 황금시대의 불러 꽃 하는 싶이 그들에게 것이다. 석가는 꾸며 있는 장식하는 대고, 심장의 청춘의 같으며, 것이다. 동력은 때에, 발휘하기 있는가?
그들은 수 이상의 곳이 생생하며, 노년에게서 황금시대다. 못할 이 착목한는 지혜는 것이다. 하여도 이성은 싹이 넣는 그리하였는가?
보내는 우리 더운지라 공자는 때에, 이것이다. 오직 피가 보는 꽃 위하여, 과실이 스며들어 교향악이다.</p>
<p>Eleifend eleifend dolor augue tincidunt bibendum faucibus. At dictumst, dui cras molestie auctor. Praesent sem nunc vel habitant sociosqu habitasse eros facilisi!
Dolor sem rhoncus sapien. Ultricies lacinia auctor faucibus orci tempus mattis eleifend nascetur vitae amet duis? Id urna sit urna litora platea pretium. Ultrices dictumst dui natoque lacinia magna feugiat. Ante fringilla.</p>
<img src="#0" />
<p>Cum imperdiet nisl fames maecenas facilisi auctor adipiscing vel iaculis nostra cras varius. Et parturient vehicula vivamus parturient sit ipsum purus tellus. Convallis integer nulla sodales eros quisque lectus nisi suspendisse tortor tellus per.
Porttitor platea class urna condimentum maecenas habitasse suspendisse platea. Habitant sociosqu velit suscipit commodo fusce enim congue. Sociis dis, iaculis cras. Tempor potenti netus etiam per risus proin risus vel ac volutpat litora orci.
Suscipit tristique senectus elit nisi magna feugiat nibh class bibendum volutpat lobortis. Non dignissim conubia aliquam risus est.</p>

<p>Metus, risus pulvinar ante erat maecenas nec mauris. Conubia senectus parturient placerat imperdiet himenaeos. Curae; nulla aliquet sit pharetra sociis lorem nisi neque. Ante sagittis quam habitant erat lacinia praesent dictum.
Himenaeos leo egestas dictumst sociis, aenean primis malesuada. Tristique, laoreet integer senectus consectetur. Purus dis gravida est per quisque fames tortor accumsan netus orci. Nam curabitur volutpat egestas ad!
Fermentum magnis quisque sociosqu elementum mauris per pretium. Elit platea ac eget natoque dolor vivamus malesuada convallis phasellus venenatis platea. Dictum quis magna imperdiet ante ad class nascetur class.</p>
<img src="#1" />
<p>Interdum nisi, proin pellentesque egestas congue rutrum. Rutrum magna auctor venenatis sit nascetur! Tristique ultricies rutrum dolor semper sapien proin penatibus auctor sodales ac scelerisque ullamcorper. Lorem orci mi potenti,
litora dictumst inceptos vitae augue scelerisque odio. Tincidunt libero fermentum lacus tristique fusce fermentum penatibus. Inceptos ultricies at pharetra consequat! Suscipit taciti tempus class vehicula sapien nullam! Turpis elementum eget vel commodo.
Donec dignissim bibendum ipsum. Consectetur adipiscing eros est dui dis nam interdum lacus gravida mattis dictum. Porta.</p>

<p>Felis sit mi aenean cum habitant pharetra ultrices nulla urna tortor scelerisque. Suspendisse bibendum laoreet sapien. Erat conubia aptent placerat et donec vivamus nunc.
Inceptos facilisi iaculis amet sed non suspendisse class elit turpis cras! Pharetra purus conubia posuere egestas condimentum tempor sem venenatis urna velit.
Non euismod metus amet. Dictum justo ultrices etiam, eu montes tempor vivamus lectus ornare! Phasellus elit.</p>
</textarea>
</div>

<div data-role="fieldcontain">
<label>options.openType [all|closed|neighbor|agreedNeighbor] </label>
<input type="text" name="options.openType" value="all" />
</div>

<div data-role="fieldcontain">
<label>image </label>
<input type="file" name="image[]" />
</div>


<div data-role="fieldcontain">
<label>image </label>
<input type="file" name="image[]" />
</div>

</form>
</body>
</html>