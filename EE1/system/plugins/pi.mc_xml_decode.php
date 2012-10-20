<?php

/*
	MC XML Decode Plugin

	@package        ExpressionEngine
	@subpackage     Addons
	@category       Plugin
	@author         Michael C.
	@link           http://www.pro-image.co.il/
	@description    A reverse-engineered version of Rick Ellis' 'XML Encode' plugin.
*/



$plugin_info = array(
						'pi_name'			=> 'MC XML Decode',
						'pi_version'		=> '1.1',
						'pi_author'			=> 'Michael C',
						'pi_author_url'		=> 'http://www.pro-image.co.il',
						'pi_description'	=> "A reverse-engineered version of Rick Ellis' 'XML Encode' plugin.",
						'pi_usage'			=> Mc_xml_decode::usage()
					);



class Mc_xml_decode {

	var $return_data;

	/** ----------------------------------------
	/**  XML Decoding function
	/** ----------------------------------------*/

	function Mc_xml_decode($str = '')
	{
		/*
		 * As seen here: https://github.com/newism/nsm.body_class.ee_addon/pull/1/files
		 * @danott fork
		 * Technique from @erikreagan in Dan Benjamin's Shrimp plugin
		 * EE version check to properly reference our EE objects
		 */
		if (version_compare(APP_VER, '2', '<'))
		{
			// EE 1.x is in play
			global $TMPL;
			$this->TMPL =& $TMPL;
		} else {
			// EE 2.x is in play
			$this->EE  =& get_instance();
			$this->TMPL =& $this->EE->TMPL;
		}

		$this->return_data = '';

		if ($str == '')
			$str = $this->TMPL->tagdata;

		$str = html_entity_decode(str_replace('&nbsp;','&amp;nbsp;',$str), ENT_QUOTES, 'UTF-8');
		$this->return_data = $str;
	}
	/* END */

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start();
?>
This plugin converts entities into XML characters. To use it, wrap anything you want to be processed between these tag pairs:

{exp:mc_xml_decode}text you want processed{/exp:mc_xml_decode}


For example:

{exp:mc_xml_decode}
<p>&#123;embed=&quot;site/index&#34;&#125;</p>
{/exp:mc_xml_decode}

results in:

<p>{embed="site/index"}</p>

Which, incidentally, will actually embed the site/index template inside those <p> tags, which is silly. So don't do that.

<?php
$buffer = ob_get_contents();

ob_end_clean();

return $buffer;
}
/* END */
}
// END CLASS
?>