import 'express-async-errors'
import express,{Request, Response, NextFunction} from 'express' // importa o express para o projeto
import routes from './routes'
import AppError from './utils/AppError'
import cors from 'cors'
import { IndentStyle } from 'typescript'
import { ZodError } from 'zod'

const app = express() // inicia o express no projeto

app.use(cors())
app.use(express.json())
app.use(routes) // utilizando as rotas no projeto
app.use((
    error: Error,
    req: Request,
    res: Response,
    next: NextFunction
)=>{

    if(error instanceof ZodError){
        return res.status(400)
        .send({
            message: "Erro de validação",
            issues: error.format()
        })
    }

    if(error instanceof AppError){
        return res.status(error.statusCode).json({
            status: "Error",
            message: error.mensagem
        })
    }

    return res.status(500).json({
        status: 'error',
        message: 'Não deu bom'
    })
})

const PORT = 3002

app.listen(PORT, ()=>{
    console.log('Iniciando projeto na porta '+ PORT)
})
