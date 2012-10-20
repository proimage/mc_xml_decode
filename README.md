Plugin: MC XML Decode
=====================
This plugin converts entities into XML characters.


Changelog
=========
- 1.0 (2010-12-28): Initial public release
- 1.1 (2012-10-20): Ported plugin to EE2; renamed to "MC XML Decode"


Examples
========

Input:

	{exp:xml_decode}
	<p>&#123;embed="site/index"&#125;</p>
	{/exp:xml_decode}


Output:

	<p>{embed="site/index"}</p>