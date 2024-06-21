import express from 'express'
import allItens from './allitens';
import connection from './connection';
import routes from './routers'

const app = express();

app.use(express.json());
app.use(routes) // utilizando as rotas no projeto

const PORT = 3003;

app.listen(PORT, ()=>{
    console.log('Funcionando na porta 3003')
})

