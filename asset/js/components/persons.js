export const getRowPerson = (person) => {
    const line = document.createElement('tr')
    line.innerHTML = `
    <td>${person.id}</td>
    <td>${person.last_name}</td>
    <td>${person.first_name}</td>
    <td>${person.address}</td>
    <td>${person.zip_code}</td>
    <td>${person.city}</td>
    <td>${person.phone}</td>
    <td>${person.type === 1 ? 'Eleve' : 'Prof'}</td>
    <td></td>
    `
    return line
}