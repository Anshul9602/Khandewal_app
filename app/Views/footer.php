<div class="footer">
            <div class="copyright">
                <p>Copyright © MOJ &amp; Developed by <a href="" target="_blank">TheOdin</a> 2024</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
		
        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
		<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart-js/chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
		<script src="vendor/apexchart/apexchart.js"></script>
	
    <!-- Vectormap -->
	<!-- Chart piety plugin files -->
    <script src="vendor/peity/jquery.peity.min.js"></script>
	
    <!-- Chartist -->
    <script src="vendor/chartist/js/chartist.min.js"></script>
	
	<!-- Dashboard 1 -->
		<script src="js/dashboard/dashboard-1.js"></script>
	<!-- Svganimation scripts -->
	     <script src="./vendor/svganimation/vivus.min.js"></script>
    <script src="./vendor/svganimation/svg.animation.js"></script>
    
	<script>
	function getUrlParams(dParam) {
		var dPageURL = window.location.search.substring(1),
			dURLVariables = dPageURL.split('&'),
			dParameterName,
			i;

		for (i = 0; i < dURLVariables.length; i++) {
			dParameterName = dURLVariables[i].split('=');

			if (dParameterName[0] === dParam) {
				return dParameterName[1] === undefined ? true : decodeURIComponent(dParameterName[1]);
			}
		}
	}
	
	(function($) {
		"use strict"

		var direction =  getUrlParams('dir');
		if(direction != 'rtl')
		{direction = 'ltr'; }
		
		var dezSettingsOptions = {
			typography: "roboto",
			version: "light",
			layout: "vertical",
			headerBg: "color_1",
			navheaderBg: "color_3",
			sidebarBg: "color_1",
			sidebarStyle: "full",
			sidebarPosition: "fixed",
			headerPosition: "fixed",
			containerLayout: "wide",
			direction: direction
		};
		
		new dezSettings(dezSettingsOptions); 

		jQuery(window).on('resize',function(){
			
			var sidebar = 'full';
			var screenWidth = jQuery(window).width();
			if(screenWidth < 600){
				sidebar = 'overlay';
			}else if(screenWidth > 600  && screenWidth < 1199){
				sidebar = 'mini';
			}
			
			dezSettingsOptions.sidebarStyle = sidebar;
			
			new dezSettings(dezSettingsOptions); 
		});
		
	})(jQuery);
	</script>

</body>
</html>