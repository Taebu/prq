       <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
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
/*
            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
				*/


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
			url: "/prq/dropzone/upload/"+param,
			autoProcessQueue: true,
			uploadMultiple: false,
			parallelUploads: 1,
			maxFiles: 1,
			addRemoveLinks: true,
			maxFileSize: 1,
			/**/

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
			acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
			 init: function() {
				
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
						thisDropzone.options.thumbnail.call(thisDropzone,mockfile,"/prq/uploads/"+$("#mb_imgprefix").val()+"/"+value.name);
					});

				}
			},
			error: function(file)
			{
///				alert("오류 파일 여러개를 지원하지 않거나 업로드에 실패 했습니다. \n따라서 "+file.name+" 업로드 된 파일을 삭제 합니다.");
//				file.previewElement.parentNode.removeChild(file.previewElement);
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
/*
		<input type="hidden" name="mb_business_paper" id="mb_business_paper">
		<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
		<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
*/
		/* 사업자 등록증 */
		$("#my-awesome-dropzone1").dropzone(set_dropzone_config("mb_business_paper"));

		/* 총판 계약서*/
		$("#my-awesome-dropzone2").dropzone(set_dropzone_config("mb_distributors_paper"));

		/* 통장 사본 */
		$("#my-awesome-dropzone3").dropzone(set_dropzone_config("mb_bank_paper"));

		/*End Dropzone*/		
        });
		
		/*End $(function(){});*/
/*
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "Se1ptember",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        $("#basic_slider").noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#range_slider").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#drag-fixed").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

*/
    </script>

</body>

</html>