<?php

namespace HeimrichHannot;

class BootstrapperHooks extends \Controller
{

    public function parseWidgetHook($strBuffer, $objWidget)
    {
        if(TL_MODE == 'BE') return $strBuffer;

        return static::generateForm($objWidget, strlen($objWidget->label) == 0);
    }

    public function replaceInsertTagsHooks($strTag)
    {
        $params = preg_split('/::/', $strTag);

        if(is_array($params) && !empty($params))
        {
            if(strpos($params[0], 'small') === 0)
            {
                return '<small>';
            }

            if(strpos($params[0], '/small') === 0)
            {
                return '</small>';
            }

            if(strpos($params[0], 'u') === 0)
            {
                return '<u>';
            }

            if(strpos($params[0], '/u') === 0)
            {
                return '</u>';
            }

            if(strpos($params[0], 'loremipsum') === 0)
            {
                $text = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet
                a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu,
                consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi
                vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus
                eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam
                nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.
                Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros
                faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,';

                // trim length
                if(is_numeric($params[1]))
                {
                    $text = \String::substr($text, $params[1]);
                }

                return $text;
            }
        }
        return false;
    }
}