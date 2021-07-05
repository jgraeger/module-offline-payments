<?php

namespace Modules\OfflinePayments\Parser;


class Markdown extends ParsedownExtra
{
    protected function inlineEmphasis($Excerpt)
    {
        $res = parent::inlineEmphasis($Excerpt);
        
        
        $res['element']['attributes'] = array(
            'style' => $this->bootstrapTextClass($res['element']['name']),
        );

        return $res;
    }

    private function bootstrapTextClass($emphasis) 
    {
        if ($emphasis === 'strong')
            return 'font-weight-bold';

        if ($emphasis === 'em')
            return 'font-weight-light';

        return '';
    }
}