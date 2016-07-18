<footer style="background-color: #304FFE" class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">{{Lang::get('detail.about')}}</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Alamat Kantor</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Indonesia</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">email@email.com</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">876543210</a></li>
                </ul>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">{{Lang::get('detail.language.label')}}</h5>
              </div>
              <div class="col l4 s12 offset-l2 m6">
                <select class="">
                  <option value="" disabled>Choose your option</option>
                  <option value="" data-icon="http://localhost/kh/img/flag_en.png" class="left responsive-img">English</option>
                  <option value="" data-icon="http://localhost/kh/img/flag_id.png" class="left responsive-img" selected>Indonesia</option>
                </select>
                <label>Images in select</label>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2016 Copyright 
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
		</footer>
	<!--  Scripts-->
		<script type="text/javascript">
      		$(document).ready(function() {
      		$('select').material_select();})
    	</script>
    <!--script-->