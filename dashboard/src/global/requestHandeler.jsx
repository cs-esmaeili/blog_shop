export const requestHandeler = async (
    requestMethod,
    sucsessfullMethod,
    failerMethood,
    catchMethod
) => {
    try {
        const respons = await requestMethod;
        console.log(respons);
        if (respons.data.statusText === "ok") {
            sucsessfullMethod(respons);
            console.log("ok");
        } else {
            console.log("fail");
            failerMethood(respons);
        }
    } catch (error) {
        console.log('catch');
        catchMethod(error);
    }
};
