<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    @php

                        $imgUrl = asset('img/foxsys-xyz [Icon] [Light Back].png');

                    @endphp

                    {{ Illuminate\Mail\Markdown::parse('<img src="' . $imgUrl . '" style="vertical-align: middle;margin-bottom: 0.3rem;" width="16px" /> foxsys-xyz') }}
                </td>
            </tr>
        </table>
    </td>
</tr>
