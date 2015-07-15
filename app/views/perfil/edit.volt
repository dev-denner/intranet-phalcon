{{ content() }}
{{ form("perfil/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("perfil", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit perfil</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="DESCRIPTION">DESCRIPTION</label>
        </td>
        <td align="left">
            {{ text_field("DESCRIPTION", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="STATUS">STATUS</label>
        </td>
        <td align="left">
            {{ text_field("STATUS", "size" : 30) }}
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
