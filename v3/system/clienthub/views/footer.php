				</div>
			</div>
			<div id="footer" class="row" style="color: #aaa; text-align: right;">
				<span class="pull-right">Responsed in <?=$this->benchmark->elapsed_time(); ?> secs.<br>© 2012 ClientHub V1.0 <a href="<?=site_url("license.txt"); ?>">License</a></span>
			</div>
		</div>
		<script type="text/javascript">
			$().ready(function(){
				$("#quickaccess")
				.keypress(function(event){
					if(event.charCode === 13){
						$(location).attr("href", "<?=site_url("clients/profile"); ?>/" + $(this).val());
						return false;
					}
				})
				.tooltip({title : "Enter to Go!", placement : "bottom", trigger : "focus"});
			});
		</script>
	</body>
</html>