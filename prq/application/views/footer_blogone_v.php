
	   <div class="footer">
            <div class="pull-right">
			Page rendered in <strong>{elapsed_time}</strong> seconds. {memory_usage}<br>
			blog write
                <!-- 10GB of <strong>250GB</strong> Free. -->
            </div>
            <div>
                <strong>Write Copyright</strong> ANPR Company &copy; 2014-2015
            </div>

        </div><!-- .footer -->

        </div><!-- #page-wrapper -->
</div><!-- #wrapper -->

    <!-- Mainly scripts -->
    <script src="/prq/include/js/jquery-2.1.1.js"></script>
    <script src="/prq/include/js/bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/prq/include/js/inspinia.js"></script>
    <script src="/prq/include/js/plugins/pace/pace.min.js"></script>
    <script src="/prq/include/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Chosen -->
    <script src="/prq/include/js/plugins/chosen/chosen.jquery.js"></script>

	<!-- Sweet alert -->
    <script src="/prq/include/js/plugins/sweetalert/sweetalert.min.js"></script>

   <!-- JSKnob -->
   <script src="/prq/include/js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- Input Mask-->
    <script src="/prq/include/js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="/prq/include/js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="/prq/include/js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="/prq/include/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="/prq/include/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="/prq/include/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="/prq/include/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="/prq/include/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="/prq/include/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="/prq/include/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="/prq/include/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="/prq/include/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="/prq/include/js/plugins/select2/select2.full.min.js"></script>

    <!-- DROPZONE mtb-->
    <script src="/prq/include/js/plugins/dropzone/dropzone_mtb.js"></script>

	<!-- Toastr script -->
    <script src="/prq/include/js/plugins/toastr/toastr.min.js"></script>
	<script>
	
	var img_file_cnt=0;

	var img_index=1;

	var img_filenames=[];
	var imgs=[];
	imgs[0]=0;
	imgs[1]=0;
	imgs[2]=0;
	var str_img1="";
	var str_img2="";
	var str_img3="";

        $(document).ready(function(){

		Dropzone.autoDiscover = false;

	
		function set_dropzone_config(id)
		{
			var file_key=[];
			/* 사업자등록증*/
			file_key["d1x"]="BS";
			/* 총판 계약서*/
			file_key["d2x"]="DS";
			/* 통장 사본 */
			file_key["d3x"]="BK";
			var param="";
			if(id!="")
			{
				param=$("#bl_imgprefix").val()+"/";
			}


			/*
			var prefix_path="";
			prefix_path=$("#mb_imgprefix").val();
			if(prefix_path!="")
			{
				param+=prefix_path+"/";
			}
			*/

			return {
			//url: "/prq/dropzone/upload/"+param,
			url: "/prq/dropzone/thumbnail/"+param,
			autoProcessQueue: true,
			uploadMultiple: true,
			parallelUploads: 20,
			maxFiles: 30,
			addRemoveLinks: true,
			maxFileSize: 30,
			dictDefaultMessage: "여기에 드래그 해서 업로드 해주세요.",
			dictFallbackMessage: "이 브라우저는 드래그앤 드롭을 지원하지 않습니다.",
			dictFallbackText: "옛날에 같은 파일을 업로드 아래의 대체 양식을 사용하세요",
			dictFileTooBig: "파일이 너무 큽니다.({{filesize}}MiB). 최대 가능 파일 사이즈 : {{maxFilesize}}MiB.",
			dictInvalidFileType: "업로드 할 수 없는 타입니다.",
			dictResponseError: "서버 에러 {{statusCode}} 코드.",
			dictCancelUpload: "업로드 취소",
			dictCancelUploadConfirmation: "정말 업로드를 취소 하시겠습니까?",
			dictRemoveFile: "파일 삭제",
			dictRemoveFileConfirmation: null,
			dictMaxFilesExceeded: "더이상 파일을 업로드 할 수 없습니다.",
			/**/
			dictResponseError: "Ha ocurrido un error en el server",
			acceptedFiles: 'image/*',

			init: function() {
				/*
				thisDropzone.on('maxfilesexceeded',function(fil){
					console.log('you con only upload 1 file');
				});
				*/

				var object=[];

					
				var mode=$("#mode").val();
				var d1x_max=$("#d1x_size").val();
				var d2x_max=$("#d2x_size").val();
				var d3x_max=$("#d3x_size").val();
				imgs[0]=d1x_max;
				imgs[1]=d2x_max-d1x_max;
				imgs[2]=d3x_max-d2x_max;
				//if(mode=="modify"||mode=="view"){
				if(mode=="modify"){
					var thisDropzone=this;

					var img_name="";
					if(file_key[id]=="BS"){
						for (var i=0;i<d1x_max;i++)
						{
							console.log(i);
							console.log("test");
							img_name=$("#img_zone_"+i).val();
							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					
					if(file_key[id]=="DS"){
						for (var i=d1x_max;i<d2x_max;i++)
						{
							console.log(i);
							console.log("test");
							img_name=$("#img_zone_"+i).val();
							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					
					if(file_key[id]=="BK"){
						console.log(d2x_max+" / "+d3x_max);
						for (var i=d2x_max;i<d3x_max;i++)
						{
							console.log("test");
							console.log(i);
							img_name=$("#img_zone_"+i).val();

							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					$.each(object,function(key,value){
						var mockfile={name:value.name,size:value.size};
						/*파일이 경로가 존재한다면*/
						if(value.name!="")
						{
						//$("#"+id).val(value.name);
						//$("#"+id+"_size").val(value.size);
						//console.log(thisDropzone.options.addedfile);
						//console.log(thisDropzone.options.thumbnail);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#bl_imgprefix").val()+"/"+value.name);
						}
					});
				}
				/*
				this.on("addedfile", function() {
				  if (this.files[1]!=null){

					//this.removeFile(this.files[0]);
				  }
				});
				*/
			  },
			success:function(file,data){
				//alert('test');
			 },
			successmultiple: function(file,data)
			{

				console.log("file_key  ->  "+file_key[id]);
				var success_index=0;
				var thisDropzone=this;
				var file_index=0;
				if(file[0].status == "success")
				{
					//var json = JSON.parse(response);
					console.log(data);
					var element;
					img_file_cnt=$("#my-awesome-dropzone1>.dz-preview").not('.dz-thumb').length;
					img_file_cnt+=$("#my-awesome-dropzone2>.dz-preview").not('.dz-thumb').length;
					img_file_cnt+=$("#my-awesome-dropzone3>.dz-preview").not('.dz-thumb').length;
					console.log("img_file_cnt : "+img_index+" / "+img_file_cnt);

					console.log(file);	
					for (var i=0;i<file.length;i++)
					{
					(element = file[i].previewElement) != null ?element.parentNode.removeChild(file[i].previewElement) :false;
					}
					console.log(element);

					$.each(data,function(key,value){

						var mockfile={name:value.name,size:value.size};
						console.log("name : "+value.name);
						console.log("size : "+value.size);
						
						if(file_key[id]=="BS"){
							console.log("BS index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length;

							console.log(file_index);	
						}

						if(file_key[id]=="DS"){
							console.log("DS index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length+$("#my-awesome-dropzone2 .dz-preview").length;
							console.log(file_index);	
						}
						
						if(file_key[id]=="BK"){
							console.log("BK index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length+$("#my-awesome-dropzone2 .dz-preview").length+$("#my-awesome-dropzone3 .dz-preview").length;
							console.log(file_index);

						}						
						//img_filenames.push(value.name);
						//arr.splice(2, 0, "Lene");
						img_filenames.splice(file_index, 0, value.name);
						/*
						console.log(img_filenames);

						console.log(id);
						$("#"+id).val(value.name);
						$("#"+id+"_size").val(value.size);
						*/


						imgs[0]=$("#my-awesome-dropzone1 .dz-preview").length-3;
						imgs[1]=$("#my-awesome-dropzone2 .dz-preview").length-3;
						imgs[2]=$("#my-awesome-dropzone3 .dz-preview").length-3;
						
						console.log("thisDropzone : ");
						console.log(thisDropzone.options);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#bl_imgprefix").val()+"/"+value.name);
						console.log("success_index : "+success_index);
					});
					var object=[];
					for (var i in img_filenames) {
						object.push('<input type="text" name="img_src[]" id="img_'+i+'" class="form-control" value="'+img_filenames[i]+'">');
					}
					$("#image_area").html(object.join(""));

	//				$("#bl_file").val(img_filenames.length);
					$("#bl_file").val($("#my-awesome-dropzone1 .dz-preview").length-3+"_"+$("#my-awesome-dropzone2 .dz-preview").length-3+"_"+$("#my-awesome-dropzone3 .dz-preview").length-3);
					img_index=img_file_cnt;
				}
			},
			error: function(file)
			{
				//alert("오류 파일 여러개를 지원하지 않거나 업로드에 실패 했습니다. \n따라서 "+file.name+" 업로드 된 파일을 삭제 합니다.");
				//file.previewElement.parentNode.removeChild(file.previewElement);

				//<div class="dz-message" data-dz-message><span>Your Custom Message</span></div>
				console.log('error');
			},
			removedfile: function(file, serverFileName) 
			{
				/* 이미지 파일 이름 배열에서 제거 */
				img_filenames.splice(img_filenames.indexOf(file.name), 1);
				console.log(img_filenames);
				var object=[];
				for (var i in img_filenames) {
					object.push('<input type="text" name="img_src[]" id="img_'+i+'" class="form-control" value="'+img_filenames[i]+'">');
				}


				var name = file.name;
				var param="filename="+name;
				console.log("removedfile : ");
				console.log(this);
				var remove_file=this;
				console.log("file size : "+this.files);
				param+="&bl_imgprefix="+$("#bl_imgprefix").val();

				$.ajax({
					type: "POST",
					url: "/prq/dropzone/delthumb",
					data:param,
					success: function(data)
					{
						var json = JSON.parse(data);
						if(json.res == true)
						{
							var element;
							(element = file.previewElement) != null ? 
							element.parentNode.removeChild(file.previewElement) : 
							false;
							//alert("요소를 제거: " + name); 
							/*
							$("#"+id).val("");
							$("#"+id+"_paper").val("");
							*/
							image_file_count--;
							console.log("image_file_count : "+image_file_count);
							toastr.clear();
							toastr.success(json.file,"파일삭제");
						}else{
							var element;
							(element = file.previewElement) != null ? 
							element.parentNode.removeChild(file.previewElement) : 
							false;
							toastr.clear();
							toastr.error(json.file,"파일삭제");
						}


						imgs[0]=$("#my-awesome-dropzone1 .dz-preview").length-3;
						imgs[1]=$("#my-awesome-dropzone2 .dz-preview").length-3;
						imgs[2]=$("#my-awesome-dropzone3 .dz-preview").length-3;

						$("#image_area").html(object.join(""));
						$("#bl_file").val(imgs[0]+"_"+imgs[1]+"_"+$("#my-awesome-dropzone3 .dz-preview").length);

					},error: function(data)
					{
						file.previewElement.parentNode.removeChild(file.previewElement);
						alert("서버 에러 업로드 파일을 삭제 합니다." ); 
						console.log("error");
					}
				});
			}
		};
		}



		function set_dropzone_config2(id)
		{
			var file_key=[];
			/* 사업자등록증*/
			file_key["d1x"]="BS";
			/* 총판 계약서*/
			file_key["d2x"]="DS";
			/* 통장 사본 */
			file_key["d3x"]="BK";
			var param="";
			if(id!="")
			{
				param=$("#bl_imgprefix").val()+"/";
			}


			/*
			var prefix_path="";
			prefix_path=$("#mb_imgprefix").val();
			if(prefix_path!="")
			{
				param+=prefix_path+"/";
			}
			*/

			return {
			//url: "/prq/dropzone/upload/"+param,
			url: "/prq/dropzone/thumbnail/"+param,
			autoProcessQueue: true,
			uploadMultiple: true,
			parallelUploads: 20,
			maxFiles: 30,
			addRemoveLinks: true,
			maxFileSize: 30,
//			clickable:false,
			dictDefaultMessage: "여기에 드래그 해서 업로드 해주세요.",
			dictFallbackMessage: "이 브라우저는 드래그앤 드롭을 지원하지 않습니다.",
			dictFallbackText: "옛날에 같은 파일을 업로드 아래의 대체 양식을 사용하세요",
			dictFileTooBig: "파일이 너무 큽니다.({{filesize}}MiB). 최대 가능 파일 사이즈 : {{maxFilesize}}MiB.",
			dictInvalidFileType: "업로드 할 수 없는 타입니다.",
			dictResponseError: "서버 에러 {{statusCode}} 코드.",
			dictCancelUpload: "업로드 취소",
			dictCancelUploadConfirmation: "정말 업로드를 취소 하시겠습니까?",
			dictRemoveFile: "파일 삭제",
			dictRemoveFileConfirmation: null,
			dictMaxFilesExceeded: "더이상 파일을 업로드 할 수 없습니다.",
			/**/
			dictResponseError: "Ha ocurrido un error en el server",
			acceptedFiles: 'image/*',

			init: function() {
				/*
				thisDropzone.on('maxfilesexceeded',function(fil){
					console.log('you con only upload 1 file');
				});
				*/
				
				
				/* addedfile */
				this.on('addedfile', function(file){
					console.log(file.name + " is in Dropzone");
					$( "#dx_1_"+ $("#dropzone_id").val()).hide();
				});


				/* removedfile */
				this.on('removedfile', function(file){
					//$.get('handler.php?action=remove&name='+file.name);
					//console.log(file.name);
					//console.log(this);
					//console.log();
					
					//$( "#dx_1_"+ $("#del_id").val()).show();
					$( "#dx_1_"+ file.previewElement.id).show();

				});

				/* selectedfiles */
				this.on('selectedfiles', function(files){
					$.each(files, function (index,file){
						console.log(file.name + ' is selected');
					});
				});
				/* thumbnail */
				this.on('thumbnail', function(file, dataUri) {
					console.log(dataUri);
				});
					
									
				var object=[];
				object.push({
				name: "이미지를 첨부해 주세요.", 
				size:  0
				});
				object.push({
				name: "이미지를 첨부해 주세요.", 
				size:  0
				});
				object.push({
				name: "이미지를 첨부해 주세요.", 
				size:  0
				});
					$.each(object,function(key,value){
						var mockfile={name:value.name,size:value.size};
						/*파일이 경로가 존재한다면*/
						if(value.name!="")
						{
						//$("#"+id).val(value.name);
						//$("#"+id+"_size").val(value.size);
						
						//thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						//thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#bl_imgprefix").val()+"/"+value.name);
						}
					});
					
				var mode=$("#mode").val();
				var d1x_max=$("#d1x_size").val();
				var d2x_max=$("#d2x_size").val();
				var d3x_max=$("#d3x_size").val();
				imgs[0]=d1x_max;
				imgs[1]=d2x_max-d1x_max;
				imgs[2]=d3x_max-d2x_max;
				//if(mode=="modify"||mode=="view"){
				if(mode=="modify"){
					var thisDropzone=this;

					var img_name="";
					if(file_key[id]=="BS"){
						for (var i=0;i<d1x_max;i++)
						{
							console.log(i);
							console.log("test");
							img_name=$("#img_zone_"+i).val();
							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					
					if(file_key[id]=="DS"){
						for (var i=d1x_max;i<d2x_max;i++)
						{
							console.log(i);
							console.log("test");
							img_name=$("#img_zone_"+i).val();
							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					
					if(file_key[id]=="BK"){
						console.log(d2x_max+" / "+d3x_max);
						for (var i=d2x_max;i<d3x_max;i++)
						{
							console.log("test");
							console.log(i);
							img_name=$("#img_zone_"+i).val();

							object.push({
							name: img_name, 
							size:  $("#img_size_"+i).val()
							});
							img_filenames.push(img_name);
						}
					}
					$.each(object,function(key,value){
						var mockfile={name:value.name,size:value.size};
						/*파일이 경로가 존재한다면*/
						if(value.name!="")
						{
						//$("#"+id).val(value.name);
						//$("#"+id+"_size").val(value.size);
						console.log(thisDropzone.options.addedfile);
						console.log(thisDropzone.options.thumbnail);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#bl_imgprefix").val()+"/"+value.name);
						}
					});
				}
				/*
				this.on("addedfile", function() {
				  if (this.files[1]!=null){

					//this.removeFile(this.files[0]);
				  }
				});
				*/
			  },
			success:function(file,data){
				//alert('test');
			 },
			successmultiple: function(file,data)
			{

				console.log("file_key  ->  "+file_key[id]);
				var success_index=0;
				var thisDropzone=this;
				var file_index=0;
				if(file[0].status == "success")
				{
					//var json = JSON.parse(response);
					console.log(data);
					var element;
					img_file_cnt=$("#my-awesome-dropzone1>.dz-preview").length-3;
					img_file_cnt+=$("#my-awesome-dropzone2>.dz-preview").length-3;
					img_file_cnt+=$("#my-awesome-dropzone3>.dz-preview").length-3;
					console.log("img_file_cnt : "+img_index+" / "+img_file_cnt);

					console.log(file);	
					for (var i=0;i<file.length;i++)
					{
					(element = file[i].previewElement) != null ?element.parentNode.removeChild(file[i].previewElement) :false;
					}
					console.log(element);

					$.each(data,function(key,value){

						var mockfile={name:value.name,size:value.size};
						console.log("name : "+value.name);
						console.log("size : "+value.size);
						
						if(file_key[id]=="BS"){
							console.log("BS index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length;

							console.log(file_index);	
						}

						if(file_key[id]=="DS"){
							console.log("DS index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length+$("#my-awesome-dropzone2 .dz-preview").length;
							console.log(file_index);	
						}
						
						if(file_key[id]=="BK"){
							console.log("BK index -> : ");	
							file_index=$("#my-awesome-dropzone1 .dz-preview").length+$("#my-awesome-dropzone2 .dz-preview").length+$("#my-awesome-dropzone3 .dz-preview").length;
							console.log(file_index);

						}						
						//img_filenames.push(value.name);
						//arr.splice(2, 0, "Lene");
						img_filenames.splice(file_index, 0, value.name);
						/*
						console.log(img_filenames);

						console.log(id);
						$("#"+id).val(value.name);
						$("#"+id+"_size").val(value.size);
						*/


						imgs[0]=$("#my-awesome-dropzone1 .dz-preview").length-3;
						imgs[1]=$("#my-awesome-dropzone2 .dz-preview").length-3;
						imgs[2]=$("#my-awesome-dropzone3 .dz-preview").length-3;
						
						console.log("thisDropzone : ");
						console.log(thisDropzone.options);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#bl_imgprefix").val()+"/"+value.name);
						console.log("success_index : "+success_index);
					});
					var object=[];
					for (var i in img_filenames) {
						object.push('<input type="text" name="img_src[]" id="img_'+i+'" class="form-control" value="'+img_filenames[i]+'">');
					}
					$("#image_area").html(object.join(""));

	//				$("#bl_file").val(img_filenames.length);
					$("#bl_file").val($("#my-awesome-dropzone1 .dz-preview").length-3+"_"+$("#my-awesome-dropzone2 .dz-preview").length+"_"+$("#my-awesome-dropzone3 .dz-preview").length);
					img_index=img_file_cnt;
				}
			},
			error: function(file)
			{
				//alert("오류 파일 여러개를 지원하지 않거나 업로드에 실패 했습니다. \n따라서 "+file.name+" 업로드 된 파일을 삭제 합니다.");
				//file.previewElement.parentNode.removeChild(file.previewElement);

				//<div class="dz-message" data-dz-message><span>Your Custom Message</span></div>
				console.log('error');
			},
			removedfile: function(file, serverFileName) 
			{
				/* 이미지 파일 이름 배열에서 제거 */
				img_filenames.splice(img_filenames.indexOf(file.name), 1);
				console.log(img_filenames);
				var object=[];
				for (var i in img_filenames) {
					object.push('<input type="text" name="img_src[]" id="img_'+i+'" class="form-control" value="'+img_filenames[i]+'">');
				}


				var name = file.name;
				var param="filename="+name;
				console.log("removedfile : ");
				console.log(this);
				var remove_file=this;
				console.log("file size : "+this.files);
				param+="&bl_imgprefix="+$("#bl_imgprefix").val();

				$.ajax({
					type: "POST",
					url: "/prq/dropzone/delthumb",
					data:param,
					success: function(data)
					{
						var json = JSON.parse(data);
						if(json.res == true)
						{
							var element;
							(element = file.previewElement) != null ? 
							element.parentNode.removeChild(file.previewElement) : 
							false;
							//alert("요소를 제거: " + name); 
							/*
							$("#"+id).val("");
							$("#"+id+"_paper").val("");
							*/
							image_file_count--;
							console.log("image_file_count : "+image_file_count);
							toastr.clear();
							toastr.success(json.file,"파일삭제");
						}else{
							var element;
							(element = file.previewElement) != null ? 
							element.parentNode.removeChild(file.previewElement) : 
							false;
							toastr.clear();
							toastr.error(json.file,"파일삭제");
						}


						imgs[0]=$("#my-awesome-dropzone1 .dz-preview").length-3;
						imgs[1]=$("#my-awesome-dropzone2 .dz-preview").length-3;
						imgs[2]=$("#my-awesome-dropzone3 .dz-preview").length-3;

						$("#image_area").html(object.join(""));
						$("#bl_file").val(imgs[0]+"_"+imgs[1]+"_"+$("#my-awesome-dropzone3 .dz-preview").length);

					},error: function(data)
					{
						file.previewElement.parentNode.removeChild(file.previewElement);
						alert("서버 에러 업로드 파일을 삭제 합니다." ); 
						console.log("error");
					}
				});
			}
		};
		}

		/* 사업자 등록증 */
		/* $("#my-awesome-dropzone1").dropzone(set_dropzone_config("d1x")); */

		/* 총판 계약서*/
		/* $("#my-awesome-dropzone2").dropzone(set_dropzone_config("d2x")); */

		/* 통장 사본 */
		/* $("#my-awesome-dropzone3").dropzone(set_dropzone_config("d3x")); */

		$("#my-awesome-dropzone1").dropzone(set_dropzone_config2("d1x"));

		/* 통장 사본 */
		//$("#my-awesome-dropzone4").dropzone(set_dropzone_config("mb_bank_paper"));



	var is_blog=false;

	is_blog=is_blog||application=="blog"&&method=="write";
	is_blog=is_blog||application=="blog"&&method=="event";
	is_blog=is_blog||application=="blog"&&method=="writeone";
	is_blog=is_blog||application=="blog"&&method=="modify";
	is_blog=is_blog||application=="blog"&&method=="view";

	if(is_blog){
		$("nav,.footer,.theme-config").hide();
	}

	var is_blogone=false;
//	is_blogone=is_blogone||application=="blog"&&method=="writeone";
	is_blogone=is_blogone||application=="blog"&&method=="write";
	is_blogone=is_blogone||application=="blog"&&method=="event";

	if(is_blogone){
		$("#p_2_1").hide();
		$("#p_2_2").hide();
		$("#p_2_3").hide();
		$("#p_3_1").hide();
		$("#p_3_2").hide();
		$("#p_3_3").hide();
		$(".dz-default").hide();
		
	}
set_preview(1);
set_preview(2);
set_preview(3);
/*
set_preview(2);
set_preview(2);
set_preview(2);

set_preview(3);
set_preview(3);
set_preview(3);
*/
		});
function set_preview(id)
{
	var preview=[];
	preview.push('<div class="dz-preview dz-image-preview dz-thumb" style="height: 170px;" onclick="javascript:set_drop(this.id,'+id+');" id="dx_1_'+id+'">');
	preview.push('<div class="dz-details">');
	preview.push('<div class="dz-filename">');
	preview.push('<span data-dz-name=""></span></div><!-- .dz-filename -->');
	preview.push('<div class="dz-size" data-dz-size="">'+id+' 사진을 올려 주세요.</div>    ');
	preview.push('<img data-dz-thumbnail="" alt="blank_drop.png" src="/prq/uploads/blog/blank_drop.png">  ');
	preview.push('</div><!-- .dz-details -->');
	preview.push('</div><!-- .dz-preview -->');

	$("#my-awesome-dropzone1").append(preview.join(""));
}


function set_drop(id,index)
{
	toastr.success(id+'에 업로드 합니다.','업로드!!!');
	//$("#"+id).hide();
	$("#dropzone_id").val(index);
	//$("#"+id).show();
	
	console.log($("#dropzone_id").val());
}

$(document).ready(function(){

  $( "#dx_1_1" ).bind( "click", function( event ) {
	  console.log(this);
	  console.log(this.id);
	  console.log( "The mouse cursor is at (" +event.pageX + ", " + event.pageY + ")" );
	  $("#my-awesome-dropzone1").click();
	  
  });
  $( "#dx_1_2" ).bind( "click", function( event ) {
	  console.log(this);
	  console.log(this.id);
	  console.log( "The mouse cursor is at (" +event.pageX + ", " + event.pageY + ")" );
	  $("#my-awesome-dropzone1").click();
  });


  $( "#dx_1_3" ).bind( "click", function( event ) {
	  console.log(this);
	  console.log(this.id);
	  console.log( "The mouse cursor is at (" +event.pageX + ", " + event.pageY + ")" );
	  $("#my-awesome-dropzone1").click();
  });
 
//  $("#my-awesome-dropzone1").attr('onclick', '').unbind('click');
  $('#lmy-awesome-dropzone1').bind( "click", function( event ) {
	  alert('alert');
	return false;
	});


//출처: http://ddo-o.tistory.com/91 [공순이의 블로그]
});
console.log("footer_blogone_v.php");
</script>
<style type="text/css">
#my-awesome-dropzone1{
background:#fff;
border:0;
}
</style>
</body>

</html>