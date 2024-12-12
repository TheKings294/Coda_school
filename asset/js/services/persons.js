export const getPersons = async () => {
    const res = await fetch(`index.php?component=persons`, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    return await res.json()
}