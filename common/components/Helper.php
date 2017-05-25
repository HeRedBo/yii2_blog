<?php
namespace common\components;

class Helper
{

	/**
	 * 校验客户手机号
	 * @param  string $mobile 手机号
	 * @return bool 
	 */
    public function checkedMobile ($mobile)
    {
        if (!preg_match("/^1[345678][0-9]{9}$/", $mobile)) 
        {
        	return false;
        }
        return true;
    }
}
