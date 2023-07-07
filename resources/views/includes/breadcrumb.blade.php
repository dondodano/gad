<h4 class="fw-bold py-3 mb-4">
    @php
        $urlsegments =  urlSegment();
        $each_url = '';

        if(count($urlsegments) == 1)
        {
            $each_url = urlCase($urlsegments[0]);
        }else{
            $each_url .= '
            <span class="text-muted fw-light">
                <a href="/'.strtolower($urlsegments[0]).'" class="text-muted fw-light">'.urlCase($urlsegments[0]).'</a>
            </span>
            ';

            if(count($urlsegments) > 1)
            {
                foreach($urlsegments as $key => $item)
                {
                    if($key != 0)
                    {
                        $each_url .= ' / ' . urlCase($item) ;
                    }
                }

            }
        }



        echo $each_url ;
    @endphp

</h4>
