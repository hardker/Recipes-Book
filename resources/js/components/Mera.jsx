import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

function Mera() {
    const [allMera, setAllMera] = useState([]);
    const [filterresult, setFilterresult] = useState([]);
    const [serachcountry, setSearchcountry] = useState("");

    const handlesearch = (event) => {
        const search = event.target.value;
        console.log(search);
        setSearchcountry(search);

        if (search !== "") {
            const filterdata = allMera.filter((item) => {
                return Object.values(item)
                    .join("")
                    .toLowerCase()
                    .includes(search.toLowerCase());
            });
            setFilterresult(filterdata);
        } else {
            setFilterresult(allMera);
        }
    };

    useEffect(() => {
        const getMeraJson = async () => {
            try {
                const getres = await fetch("../mera.json");
                const setMera = await getres.json();
                // console.log(setMera);
                setAllMera(await setMera);
            } catch (error) {
                console.log(error);
            }
        };
        getMeraJson();
    }, []);

    return (
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Введите название продукта"
                        onChange={(e) => { handlesearch(e); }}
                    />
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Чайная ложка</th>
                                <th>Столовая ложка</th>
                                <th>Стакан 200 мл</th>
                                <th>Стакан 250 мл</th>
                                <th>Средний вес</th>
                            </tr>
                        </thead>
                        <tbody>
                            {serachcountry.length > 1
                                ? filterresult.map((filtercountry, index) => (
                                    <tr key={index}>
                                        <td class="text-start"> {filtercountry.product} </td>
                                        <td> {filtercountry.teaspoon} </td>
                                        <td> {filtercountry.tablespoon} </td>
                                        <td> {filtercountry.glass200} </td>
                                        <td> {filtercountry.glass250} </td>
                                        <td> {filtercountry.piece} </td>
                                    </tr>
                                ))
                                : allMera.map((getcon, index) => (
                                    <tr key={index}>
                                        <td class="text-start"> {getcon.product} </td>
                                        <td> {getcon.teaspoon} </td>
                                        <td> {getcon.tablespoon} </td>
                                        <td> {getcon.glass200} </td>
                                        <td> {getcon.glass250} </td>
                                        <td> {getcon.piece} </td>
                                    </tr>))
                            }
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default Mera;

if (document.getElementById('mera')) {
    const Index = ReactDOM.createRoot(document.getElementById("mera"));
    Index.render(
        <React.StrictMode>
            <Mera />
        </React.StrictMode>
    )
}

