import express, { Router, json } from 'express'
import knex from '../database/knex'
import {z} from 'zod';
import AppError from '../utils/AppError';
const router = Router()

router.get('/', async(req, res) =>{
    knex("idoso").then((agenda) =>{
        res.json({agenda})
    })
})

router.post('/', async(req,res)=>{
    const registerBodySchema = z.object({ // recebe os dados do php
        nome: z.string(), 
        cpf: z.string(), 
        telefone: z.string(), 
        endereco: z.string(), 
        historicoMedico: z.string(), 
        DataNascimento: z.string()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    await knex('idoso').insert(objSalvar) // salva no mysql
    res.json({mensagem: "Criado com sucesso!"})
})

router.put('/:id', async(req,res)=>{
    const {id} = req.params

    const registerBodySchema = z.object({ // recebe os dados do php
        nome: z.string(), 
        cpf: z.string(), 
        telefone: z.string(), 
        endereco: z.string(), 
        historicoMedico: z.string(), 
        DataNascimento: z.string()
    })
    const objSalvar = registerBodySchema.parse(req.body)

    let idoso = await knex('idoso').where({id}).first()

     idoso = {
        ...idoso,
        ...objSalvar
    }

    await knex('idoso').where({id: idoso.id}).update(idoso)

    return res.json({message: "Editado cadastro com sucesso!"})
})

router.delete('/:id', async(req,res)=>{
    const {id} = req.params

    let idoso = await knex('idoso').where({id}).first()

    if(!idoso?.id){
        throw new AppError("Visita não encontrada")
    }

    await knex('idoso').where({id}).delete()
    
    return res.json({message: 'Cadastro deletado'})
})

export default router;