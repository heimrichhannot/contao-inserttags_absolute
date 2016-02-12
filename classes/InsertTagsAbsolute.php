<?php

namespace HeimrichHannot\InsertTagsAbsolute;

use HeimrichHannot\Haste\Util\Url;

class InsertTagsAbsolute {

	public function replaceInsertTagsAbsolute($strTag)
	{
		$arrSplit = explode('::', $strTag);

		if ($arrSplit[0] == 'link_url_abs')
		{
			if (isset($arrSplit[1]))
			{
				return Url::generateAbsoluteUrl($arrSplit[1]);
			}

			return '';
		}

		return false;
	}

}