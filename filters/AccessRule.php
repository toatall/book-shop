<?php

namespace app\filters;

use Yii;

class AccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($user)
    {
    	    	
        if (empty($this->roles)) 
        {
            return true;
        }
		
        $userRole = isset(\Yii::$app->user->identity->role) 
        	? Yii::$app->user->identity->role : '?';
        
        foreach ($this->roles as $role) 
        {
            
        	if ($role === '?') 
            {
                if (Yii::$app->user->isGuest) {
                    return true;
                }
            } 
            elseif ($role === '@')
            {
                if (!Yii::$app->user->isGuest) {
                    return true;
                }
            } 
            
            
            if ($role ==  $userRole || $userRole == 'admin')
            	return true;
            
        }

        return false;
    }
}