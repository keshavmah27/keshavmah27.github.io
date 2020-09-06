<!DOCTYPE html>
<html>
<head>
	<title>
		Create Certificate
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ; ?>"></script>

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/') ?>jquery/dist/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>jquery-ui/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <style type="text/css">
    	body,*{
    		margin: 0px;
    		padding: 0px;
    	}
    </style>
</head>
<body>
	<div id="app" >
		<div class="row w-100" >
				<div class="col-4 border-right" style="height: 100vh!important;background-color: #ccc;overflow-y: auto;" >
					<form action="<?php echo base_url('admin/Request/processCreate'); ?>" enctype="multipart/form-data" method="post" >
						<input type="hidden" name="req_id" value="<?= $data->id ?>" >
					<div class="p-4">
						<h3>Set name</h3>
						<hr>
						<div class="form-group" >
							<label>Name on Certificate</label>
							<input type="text" v-model="Name"  name="">
						</div>
						<div class="form-group" >
							<label>Font-size Of Name</label>
							<input type="number" v-model="fontSize" min="14" name="certi_name_size">
						</div>
						<div class="form-group" >
							<label>Top Of Name</label>
							<input type="number" v-model="top" min="" max="" name="certi_name_to">
						</div>
						<div class="form-group" >
							<label>Left Of Name</label>
							<input type="number" v-model="left" min="" max="" name="certi_name_left">
						</div>
						<div class="form-group" >
							<label>Color Of Name</label>
							<input type="color" v-model="color"  name="certi_name_color">
						</div>
						<div class="form-group" >
							<label>Font Family</label>
							<select v-model="fontFamily" name="certi_name_font" >
								<option>Select Font-Family</option>
								<option value="Arial" >Arial</option>
								<option value="Roboto" >Roboto</option>
								<option value="Times" >Times</option>
								<option value="Georgia" >Georgia</option>
								<option value="Palatino" >Palatino</option>
								<option value="Garamond" >Garamond</option>
								<option value="Bookman" >Bookman</option>
								<option value="Comic Sans MS" >Comic Sans MS</option>
								<option value="Candara" >Candara</option>
								<option value="Verdana" >Verdana</option>
								<option value="Courier New" >Courier New</option>
								<option value="Times New Roman" >Times New Roman</option>
							</select>
						</div>
						<div class="form-group" >
							<label>Set Text Alignment</label>
							<select v-model="textAlign" name="certi_name_align" >
								<option>Select Font-Family</option>
								<option value="center" >center</option>
								<option value="left" >left</option>
								<option value="right" >right</option>
								<option value="justify" >justify</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="p-4">
						<h3>Set Url</h3>
						<hr>
						<div class="form-group" >
							<label>Url on Certificate</label>
							<input type="text" v-model="Url"  name="">
						</div>
						<div class="form-group" >
							<label>Font-size Of Url</label>
							<input type="number" v-model="UrlfontSize" min="9" name="certi_url_size">
						</div>
						<div class="form-group" >
							<label>Top Of Url</label>
							<input type="number" v-model="Urltop"  name="certi_url_top">
						</div>
						<div class="form-group" >
							<label>Left Of Url</label>
							<input type="number" v-model="Urlleft"  name="certi_url_left">
						</div>
						<div class="form-group" >
							<label>Color Of Url</label>
							<input type="color" v-model="Urlcolor"  name="certi_url_color">
						</div>
						<div class="form-group" >
							<label>Font Family Of Url</label>
							<select v-model="UrlfontFamily" name="certi_url_font" >
								<option>Select Font-Family</option>
								<option value="Arial" >Arial</option>
								<option value="Roboto" >Roboto</option>
								<option value="Times" >Times</option>
								<option value="Georgia" >Georgia</option>
								<option value="Palatino" >Palatino</option>
								<option value="Garamond" >Garamond</option>
								<option value="Bookman" >Bookman</option>
								<option value="Comic Sans MS" >Comic Sans MS</option>
								<option value="Candara" >Candara</option>
								<option value="Verdana" >Verdana</option>
								<option value="Courier New" >Courier New</option>
								<option value="Times New Roman" >Times New Roman</option>
							</select>
						</div>
						<div class="form-group" >
							<label>Set Text Alignment Url</label>
							<select v-model="UrltextAlign" name="certi_url_align" >
								<option>Select Font-Family</option>
								<option value="center" >center</option>
								<option value="left" >left</option>
								<option value="right" >right</option>
								<option value="justify" >justify</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="p-4">
						<h3>Set CredId</h3>
						<hr>
						<div class="form-group" >
							<label>ID on Certificate</label>
							<input type="text" v-model="Id"  name="">
						</div>
						<div class="form-group" >
							<label>Font-size Of Id</label>
							<input type="number" v-model="IdfontSize" min="9" name="certi_id_size">
						</div>
						<div class="form-group" >
							<label>Top Of Id</label>
							<input type="number" v-model="Idtop" name="certi_id_top">
						</div>
						<div class="form-group" >
							<label>Left Of Id</label>
							<input type="number" v-model="Idleft" name="certi_id_left">
						</div>
						<div class="form-group" >
							<label>Color Of Id</label>
							<input type="color" v-model="Idcolor"  name="certi_id_color">
						</div>
						<div class="form-group" >
							<label>Font Family Of Id</label>
							<select v-model="IdfontFamily" name="certi_id_font" >
								<option>Select Font-Family</option>
								<option value="Arial" >Arial</option>
								<option value="Roboto" >Roboto</option>
								<option value="Times" >Times</option>
								<option value="Georgia" >Georgia</option>
								<option value="Palatino" >Palatino</option>
								<option value="Garamond" >Garamond</option>
								<option value="Bookman" >Bookman</option>
								<option value="Comic Sans MS" >Comic Sans MS</option>
								<option value="Candara" >Candara</option>
								<option value="Verdana" >Verdana</option>
								<option value="Courier New" >Courier New</option>
								<option value="Times New Roman" >Times New Roman</option>
							</select>
						</div>
						<div class="form-group" >
							<label>Set Text Alignment Id</label>
							<select v-model="IdtextAlign" name="certi_id_align" >
								<option>Select Font-align</option>
								<option value="center" >center</option>
								<option value="left" >left</option>
								<option value="right" >right</option>
								<option value="justify" >justify</option>
							</select>
						</div>
					</div>
					<div class="p-4">
						<h3>Set Class</h3>
						<hr>
						<div class="form-group" >
							<label>class on Certificate</label>
							<input type="text" v-model="classsec"  name="">
						</div>
						<div class="form-group" >
							<label>Font-size Of class</label>
							<input type="number" v-model="classfontSize" min="9" name="certi_class_size">
						</div>
						<div class="form-group" >
							<label>Top Of class</label>
							<input type="number" v-model="classtop" name="certi_class_top">
						</div>
						<div class="form-group" >
							<label>Left Of class</label>
							<input type="number" v-model="classleft"  name="certi_class_left">
						</div>
						<div class="form-group" >
							<label>Color Of class</label>
							<input type="color" v-model="classcolor"  name="certi_class_color">
						</div>
						<div class="form-group" >
							<label>Font Family Of class</label>
							<select v-model="classfontFamily" name="certi_class_font" >
								<option>Select Font-Family</option>
								<option value="Arial" >Arial</option>
								<option value="Roboto" >Roboto</option>
								<option value="Times" >Times</option>
								<option value="Georgia" >Georgia</option>
								<option value="Palatino" >Palatino</option>
								<option value="Garamond" >Garamond</option>
								<option value="Bookman" >Bookman</option>
								<option value="Comic Sans MS" >Comic Sans MS</option>
								<option value="Candara" >Candara</option>
								<option value="Verdana" >Verdana</option>
								<option value="Courier New" >Courier New</option>
								<option value="Times New Roman" >Times New Roman</option>
							</select>
						</div>
						<div class="form-group" >
							<label>Set Text Alignment class</label>
							<select v-model="classtextAlign" name="certi_class_align" >
								<option>Select Font-align</option>
								<option value="center" >center</option>
								<option value="left" >left</option>
								<option value="right" >right</option>
								<option value="justify" >justify</option>
							</select>
						</div>
						<div>
							<label>Include Class</label>: 
							Yes <input type="radio" name="include_class" value="1" >
							No <input type="radio" name="include_class" value="0" >
						</div>
					</div>
						<div align="center" class=" mb-3">
							<input type="submit" class="btn btn-primary" name="save" value="save" >
						</div>
					</form>
				</div>
			<div class="col-8" style="width: 900px; height:600px;overflow: hidden;">
				<img src="<?= base_url('uploads/custom_certifications/').$data->certi_photo ?>"  id="certy"  style="width: 100%; height:100%;">
				<div v-bind:style="{width: '900px', position: 'absolute !important',fontSize: fontSize + 'px', top: top +'px', left: left+'px',color: color,fontStyle: fontStyle, fontFamily: fontFamily, textAlign: textAlign +'!important'  }" >{{Name}}</div>
				<div v-bind:style="{width: '900px', position: 'absolute !important',fontSize: UrlfontSize + 'px', top: Urltop +'px', left: Urlleft+'px',color: Urlcolor, fontFamily: UrlfontFamily, textAlign: UrltextAlign +'!important'  }" >{{Url}}</div>
				<div v-bind:style="{width: '900px', position: 'absolute !important',fontSize: IdfontSize + 'px', top: Idtop +'px', left: Idleft+'px',color: Idcolor, fontFamily: IdfontFamily, textAlign: IdtextAlign +'!important'  }" >{{Id}}</div>
				<div v-bind:style="{width: '900px', position: 'absolute !important',fontSize: classfontSize + 'px', top: classtop +'px', left: classleft+'px',color: classcolor, fontFamily: classfontFamily, textAlign: classtextAlign +'!important'  }" >{{classsec}}</div>
			</div>
		</div>
	</div>
</body>


<script type="text/javascript">
	var app = new Vue({
	  el: '#app',
	  data: {
	    message: 'Hello Vue!',
	    fontSize: 14,
	    top: 22,
	    left: 0,
	    color: '#000000',
	    fontStyle: 'normal',
	    Name: 'Name',
	    fontFamily: '',
	    textAlign: '',
	    Url: '',
	    UrlfontSize:'12',
	    Urltop:22,
	    Urlleft:0,
	    Urlcolor: '#000000',
	    UrlfontFamily: '',
	    UrltextAlign: '',
	    Id: '',
	    IdfontSize:'12',
	    Idtop:22,
	    Idleft:0,
	    Idcolor: '#000000',
	    IdfontFamily: '',
	    IdtextAlign: '',
	    classsec: '',
	    classfontSize:'12',
	    classtop:'',
	    classleft:'',
	    classcolor: '#000000',
	    classfontFamily: '',
	    classtextAlign: ''
	  },
	  methods: {
	  	
	  }
	});


	$(document).ready(() =>{
        $('#selectImg').change(function() {
          readURL(this);
        });
      });

      function readURL(input) {
      // alert("hello"); return false;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        // $('#certy').css('background-image', `url('{e.target.result}')`);
        $('#certy').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
</html>