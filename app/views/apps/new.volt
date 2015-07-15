
{{ form("apps/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("apps", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create apps</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="CONTROLLER">CONTROLLER</label>
        </td>
        <td align="left">
            {{ text_field("CONTROLLER", "size" : 30) }}
        </td>
    </tr>
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
            <label for="MODULE">MODULE</label>
        </td>
        <td align="left">
            {{ text_field("MODULE", "type" : "numeric") }}
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
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
