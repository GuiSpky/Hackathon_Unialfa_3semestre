import express, { Router, json } from 'express'
import allItens from '../allitens';
import connection from '../connection';

const router = Router()

router.get('/', async(req, res) =>{
    const [query] = await connection.execute('SELECT * FROM agenda');
    return res.status(201).json(query);
})

router.post('/', async(req, res) =>{
    req.body(json)
    const [query] = await connection.execute(
        "INSERT INTO `agenda` (`id`, `idMedico`, `idIdoso`, `dataVisita`, `horaVisita`, `info`, `IdVacina`, `DataAplicacao`) VALUES (NULL, [agente], [idoso], [data], [hora], [info], [vacina], [dataAplicado]);");
    return res.json({message:'Deu certo!'});
})

router.post

export default router;
