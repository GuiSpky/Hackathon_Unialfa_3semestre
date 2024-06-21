import express, { Router } from 'express'
import allItens from '../allitens';
import connection from '../connection';

const router = Router()

router.get('/', async(req, res) =>{
    const [query] = await connection.execute('SELECT * FROM idoso');
    return res.status(201).json(query);
})

export default router;