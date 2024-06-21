import express, { Router, json } from 'express'
import connection from '../connection';
import {z} from 'zod';
import bodyParser from 'body-parser';

const router = Router()

router.get('/', async(req, res) =>{
    const [query] = await connection.execute('SELECT * FROM agenda');
    return res.status(201).json(query);
})

router.post('/', async(req, res) =>{

    const registerBodySchema = z.object({
        agente: z.string(), 
        idoso: z.string(), 
        data: z.string(), 
        hora: z.string(), 
        info: z.string(), 
        vacina: z.string()
    })

    const objSalvar = registerBodySchema.parse(req.body)

    const [query] = await connection.execute(
        "insert into agenda (id, idMedico, idIdoso, dataVisita, horaVisita, info, IdVacina,"+
        " DataAplicacao) VALUES (NULL,'"
        +objSalvar?.agente+"','"+objSalvar?.idoso+"','"+objSalvar?.data+"','"+objSalvar?.hora+"','"
        +objSalvar?.info+"','"+objSalvar?.vacina+"', NULL);");
        res.json({message:"Deu certo!"});
})

router.put('/', async(req,res)=>{
    const registerBodySchema = z.object({
        agente: z.string(), 
        idoso: z.string(), 
        data: z.string(), 
        hora: z.string(), 
        info: z.string(), 
        vacina: z.string()
    })

    const objSalvar = registerBodySchema.parse(req.body)
    const [query] = await connection.execute('SELECT * FROM agenda');

    if(objSalvar.idoso = query[1])
    
})

export default router;
