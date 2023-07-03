<form method="POST" action="createAction">
    Descrição:<br/>
    <input type="text" name="description"/><br/><br/>

    Preço (Opcional):<br/>
    <input type="text" name="price"/><br/><br/>

    Pessoa:<br/>
    <input type="text" name="userName"/><br/><br/>

    Tipo de emprestimo:<br/>
    <select name="type" id="type">
        <option value="emprestado">
            Emprestado (eu tomo emprestado)
        </option>
        <option value="emprestando">
            Emprestando (eu empresto)
        </option>
    </select><br/><br/>

    Data de devolução:<br/>
    <input type="datetime-local" id="expectedDate" name="expectedDate"><br/><br/>

    <input type="submit" value="Criar"/>
</form>
