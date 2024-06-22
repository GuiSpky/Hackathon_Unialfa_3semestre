import express, { Router, json } from 'express'
import knex from '../database/knex'
import {z} from 'zod';
import AppError from '../utils/AppError';
const router = Router()

router.get('/', async(req, res) =>{
    knex("cuidador").then((cuidadores) =>{
        res.json({cuidadores})
    })
})

router.post('/', async(req,res)=>{
    const registerBodySchema = z.object({ // recebe os dados do php
        nome: z.string(), 
        idIdoso: z.string()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    await knex('cuidador').insert(objSalvar) // salva no mysql
    res.json({mensagem: "Criado com sucesso!"})
})

router.put('/:id', async(req,res)=>{
    const {id} = req.params

    const registerBodySchema = z.object({ // recebe os dados do php
        nome: z.string(), 
        idIdoso: z.string()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    let cuidador = await knex('cuidador').where({id}).first()

    cuidador = {
        ...cuidador,
        ...objSalvar
    }

    await knex('cuidador').where({id: cuidador.id}).update(cuidador)

    return res.json({message: "Editado cadastro com sucesso!"})
})

router.delete('/:id', async(req,res)=>{
    const {id} = req.params

    let cuidador = await knex('cuidador').where({id}).first()

    if(!cuidador?.id){
        throw new AppError("Visita não encontrada")
    }

    await knex('cuidador').where({id}).delete()
    
    return res.json({message: 'Cadastro deletado'})
})

export default router;