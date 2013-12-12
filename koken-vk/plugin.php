<?php

class KokenVK extends KokenPlugin {

    function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('after_opening_head', 'render_js');
		$this->register_hook('before_closing_body', 'render_div');
	}

	function render_div($item)
	{
//		echo '<script>var disqus_identifier = "koken_disqus_' . $item['__koken__'] . '_' . $item['id'] . '";</script><div id="disqus_thread"></div>';

		echo '<div id="vk_comments" class="main">';
		echo '<script type="text/javascript">';
		echo 'VK.Widgets.Comments("vk_comments", {limit: '.$this->data->vk_limit.', width: "'.$this->data->vk_width.'"';
		echo ', height: "'.$this->data->vk_height.'"';
		echo ', attach: "';

		$vk_attach='';

		if (($this->data->vk_attach_photo) && ($this->data->vk_attach_video) && ($this->data->vk_attach_audio) && ($this->data->vk_attach_link) && ($this->data->vk_attach_graffiti)) {
			$vk_attach.='*';
		} else {
                        if ($this->data->vk_attach_photo) {
				$vk_attach.='photo';
			}
                        if ($this->data->vk_attach_video) {
			        if ($vk_attach!='') {$vk_attach.=',';}
				$vk_attach.='video';
			}
                        if ($this->data->vk_attach_audio) {
			        if ($vk_attach!='') {$vk_attach.=',';}
				$vk_attach.='audio';
			}
                        if ($this->data->vk_attach_link) {
			        if ($vk_attach!='') {$vk_attach.=',';}
				$vk_attach.='link';
			}
                        if ($this->data->vk_attach_graffiti) {
			        if ($vk_attach!='') {$vk_attach.=',';}
				$vk_attach.='graffiti';
			}
			        if ($vk_attach=='') {$vk_attach.='-';}
		}
		echo $vk_attach;
		echo '", mini: '.$this->data->vk_mini.'';
		echo ', autoPublish: "'.$this->data->vk_autoPublish.'"});';
		echo '</script></div>';

	}

	function render_js()
	{
		echo '<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>';
		echo '<script type="text/javascript">';
		echo 'VK.init({apiId: '.$this->data->vk_Api_id.', onlyWidgets: true}); </script>';
	}
}
