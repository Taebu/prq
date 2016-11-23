       <div class="footer">
            <div class="pull-right">
			Page rendered in <strong>{elapsed_time}</strong> seconds. {memory_usage}<br>
			blog write
                <!-- 10GB of <strong>250GB</strong> Free. -->
            </div>
            <div>
                <strong>Write Copyright</strong> Example Company &copy; 2014-2015
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

    <!-- DROPZONE -->
    <script src="/prq/include/js/plugins/dropzone/dropzone.js"></script>
    <script>
        $(document).ready(function(){

		Dropzone.autoDiscover = false;

	
		function set_dropzone_config(id)
		{
			var file_key=[];
			/* 사업자등록증*/
			file_key["mb_business_paper"]="BS";
			/* 총판 계약서*/
			file_key["mb_distributors_paper"]="DS";
			/* 통장 사본 */
			file_key["mb_bank_paper"]="BK";
			thisDropzone.options.myDropzone={
			autoProcessQueue: true,
			uploadMultiple: false,
			parallelUploads: 1,
			maxFiles: 1,
			addRemoveLinks: true,
			maxFileSize: 1,
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
			dictResponseError: "Ha ocurrido un error en el server",
			acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',			
			};
			var param="";
			if(id!="")
			{
				param=file_key[id]+"/";
			}
			var prefix_path="";
			prefix_path=$("#mb_imgprefix").val();
			if(prefix_path!="")
			{
				param+=prefix_path+"/";
			}
			return {
			//url: "/prq/dropzone/upload/"+param,
			url: "/prq/dropzone/thumbnail/"+param,
			init: function() {
				
				thisDropzone.on('maxfilesexceeded',function(fil){
					console.log('you con only upload 1 file');
				});
				var mode=$("#mode").val();

				if(mode=="modify"||mode=="view"){
					var thisDropzone=this;
					var object=[];
					object.push({"name":$("#"+id).val(),"size":$("#"+id+"_size").val()});
					console.log(object);
					$.each(object,function(key,value){
						var mockfile={name:value.name,size:value.size};
						/*파일이 경로가 존재한다면*/
						if(value.name!="")
						{
						$("#"+id).val(value.name);
						$("#"+id+"_size").val(value.size);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#mb_imgprefix").val()+"/"+value.name);
						}
					});
				}

				this.on("addedfile", function() {
				  if (this.files[1]!=null){

					this.removeFile(this.files[0]);
				  }
				});
			  },success: function(file,data)
			{
				var thisDropzone=this;
				if(file.status == "success")
				{
					//var json = JSON.parse(response);
					console.log(data);
					var element;

					(element = file.previewElement) != null ? 
					element.parentNode.removeChild(file.previewElement) : 
					false;

					$.each(data,function(key,value){
						var mockfile={name:value.name,size:value.size};
						$("#"+id).val(value.name);
						$("#"+id+"_size").val(value.size);
						thisDropzone.options.addedfile.call(thisDropzone,mockfile);
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#st_imgprefix").val()+"/"+value.name);
					});
					image_file_count++;
					console.log("image_file_count : "+image_file_count);
				}
			},
			error: function(file)
			{
///				alert("오류 파일 여러개를 지원하지 않거나 업로드에 실패 했습니다. \n따라서 "+file.name+" 업로드 된 파일을 삭제 합니다.");
//				file.previewElement.parentNode.removeChild(file.previewElement);

//<div class="dz-message" data-dz-message><span>Your Custom Message</span></div>
console.log('error');
			},
			removedfile: function(file, serverFileName) 
			{
				var name = file.name;
				var param="filename="+name;
				
				param+="&mb_imgprefix="+$("#mb_imgprefix").val();
				param+="&mb_no="+$("#mb_no").val();
				param+="&mb_removetype="+id;
				$.ajax({
					type: "POST",
					url: "/prq/dropzone/delete",
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
							$("#"+id).val("");
							$("#"+id+"_paper").val("");
							image_file_count--;
							console.log("image_file_count : "+image_file_count);
						}
					},error: function(data)
					{
						file.previewElement.parentNode.removeChild(file.previewElement);
						alert("서버 에러 업로드 파일을 삭제 합니다." ); 
						$("#"+id).val("");
						$("#"+id+"_paper").val("");
						console.log("error");
					}
				});
			}
		};
		}

		/* 사업자 등록증 */
		$("#my-awesome-dropzone1").dropzone(set_dropzone_config("mb_business_paper"));

		/* 총판 계약서*/
		$("#my-awesome-dropzone2").dropzone(set_dropzone_config("mb_distributors_paper"));

		/* 통장 사본 */
		$("#my-awesome-dropzone3").dropzone(set_dropzone_config("mb_bank_paper"));

		/* 통장 사본 */
		$("#my-awesome-dropzone4").dropzone(set_dropzone_config("mb_bank_paper"));

		});
</script>

</body>

</html>