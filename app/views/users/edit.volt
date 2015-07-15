{{ content() }}
{{ form("users/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("users", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit users</h1>
</div>

<table>
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
        <td>{{ hidden_field("ID") }}</td>
        <td>{{ submit_button("Salvar") }}</td>
    </tr>
</table>

</form>
