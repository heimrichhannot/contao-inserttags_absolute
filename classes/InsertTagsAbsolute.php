<?php

namespace HeimrichHannot\InsertTagsAbsolute;

class InsertTagsAbsolute {

	public function replaceInsertTagsAbsolute($strTag)
	{
		$arrSplit = explode('::', $strTag);

		if ($arrSplit[0] == 'link_url_abs')
		{
			if (isset($arrSplit[1]))
			{
				if (($objTarget = \PageModel::findByPk($arrSplit[1])) !== null)
				{
					if ($objTarget->type == 'root')
					{
						return static::generateAbsoluteLink($objTarget);
					}
					else
					{
						foreach (\PageModel::findParentsById($objTarget->id) as $objParent)
						{
							if ($objParent->type == 'root')
							{
								return static::generateAbsoluteLink($objParent);
							}
						}
					}
				}
			}

			return '';
		}

		return false;
	}

	private static function generateAbsoluteLink($objPage)
	{
		return ($objPage->useSSL ? 'https://' : 'http://') . $objPage->dns . '/' .
			\Controller::generateFrontendUrl($objPage->row());
	}

}