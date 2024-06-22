import express, { Router, json } from 'express'
import knex from '../database/knex'
import {z} from 'zod';
import AppError from '../utils/AppError';

const router = Router()

// router.get('/', async(req, res) =>{
//     const [query] = await connection.execute('SELECT * FROM agenda');
//     return res.status(201).json(query);
// })

router.get('/', async(req, res) =>{
    knex("agenda").then((agenda) =>{
        res.json({agenda})
})})

router.post('/', async(req,res)=>{
    const registerBodySchema = z.object({ // recebe os dados do php
        idAgente: z.string(), 
        idIdoso: z.string(), 
        dataVisita: z.string(), 
        horaVisita: z.string(), 
        info: z.string(), 
        idVacina: z.string()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    await knex('agenda').insert(objSalvar) // salva no mysql
    res.json({mensagem: "Agendado com sucesso!"})
})

router.put('/:id', async(req,res)=>{
    const {id} = req.params

    const registerBodySchema = z.object({ // recebe os dados do php
        idAgente: z.string(), 
        idIdoso: z.string(), 
        dataVisita: z.string(), 
        horaVisita: z.string(), 
        info: z.string(), 
        idVacina: z.string(),
        DataAplicacao: z.string().nullable()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    let visita = await knex('agenda').where({id}).first()

    visita = {
        ...visita,
        ...objSalvar
    }

    await knex('agenda').where({id: visita.id}).update(visita)

    return res.json({message: "Editado visita com sucesso!"})
})

router.delete('/:id', async(req,res)=>{
    const {id} = req.params

    let visita = await knex('agenda').where({id}).first()

    if(!visita?.id){
        throw new AppError("Visita não encontrada")
    }

    await knex('agenda').where({id}).delete()
    
    return res.json({message: 'Visita deletada'})
})

export default router;
