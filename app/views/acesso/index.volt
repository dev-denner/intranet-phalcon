
{{ content() }}

<div align="right">
    {{ link_to("acesso/new", "Create acesso") }}
</div>

{{ form("acesso/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search acesso</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="ID">ID</label>
        </td>
        <td align="left">
            {{ text_field("ID", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PERFIL">PERFIL</label>
        </td>
        <td align="left">
            {{ text_field("PERFIL", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="ACTION">ACTION</label>
        </td>
        <td align="left">
            {{ text_field("ACTION", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PERMISSION">PERMISSION</label>
        </td>
        <td align="left">
            {{ text_field("PERMISSION", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="SOFTDEL">SOFTDEL</label>
        </td>
        <td align="left">
            {{ text_field("SOFTDEL", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="USERCREATE">USERCREATE</label>
        </td>
        <td align="left">
            {{ text_field("USERCREATE", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="DATECREATE">DATECREATE</label>
        </td>
        <td align="left">
            {{ text_field("DATECREATE", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="USERUPDATE">USERUPDATE</label>
        </td>
        <td align="left">
            {{ text_field("USERUPDATE", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="DATEUPDATE">DATEUPDATE</label>
        </td>
        <td align="left">
            {{ text_field("DATEUPDATE", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
