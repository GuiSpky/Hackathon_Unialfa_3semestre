import connection from './connection';

const allItens = async () => {
    const [query] = await connection.execute('SELECT * FROM idoso');
    return query;
}
export default allItens;