
{{ content() }}

<div align="right">
    {{ link_to("users/new", "Create users") }}
</div>

{{ form("users/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search users</h1>
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
            <label for="CPF">CPF</label>
        </td>
        <td align="left">
            {{ text_field("CPF", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PASSWORD">PASSWORD</label>
        </td>
        <td align="left">
            {{ password_field("PASSWORD", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="EMAIL">EMAIL</label>
        </td>
        <td align="left">
            {{ text_field("EMAIL", "size" : 30) }}
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
            <label for="STATUS">STATUS</label>
        </td>
        <td align="left">
                {{ select_static('STATUS', [ 'A' : 'Active', 'I' : 'Inactive']) }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
