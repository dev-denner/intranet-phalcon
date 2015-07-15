{{ content() }}
{{ form("actions/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("actions", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit actions</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="NAME">NAME</label>
        </td>
        <td align="left">
            {{ text_field("NAME", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="SLUG">SLUG</label>
        </td>
        <td align="left">
            {{ text_field("SLUG", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="APP">APP</label>
        </td>
        <td align="left">
            {{ text_field("APP", "type" : "numeric") }}
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
