/**
 * Created by BRWA on 7/22/2017.
 */

//tinymce.init({ selector:'textarea' });

// am codea wa aka gar clickman la check boxakay sarawa krd hamw awany trish select bka

$(document).ready(function ()
{

    $('#selectAllBoxes').click(function (event)
    {
        if (this.checked)
        {
            $('.checkbox').each(function ()
            {
                this.checked = true;
            });
        }
        else
        {
            $('.checkbox').each(function ()
            {
                this.checked = false;
            });
        }
    });

});