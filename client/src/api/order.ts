import IOrder from "@/interfaces/Order";
import axiosClient from "@/api/axiosClient";

const orderAPI = {
    getList: async (): Promise<IOrder[]> => {
        const url = 'api/v1/order';
        const res = await axiosClient.get(url)
        return res.data
    },

    getOrderDetail: async (orderCode: string): Promise<IOrder> => {
        const url = `api/v1/order/${orderCode}`;
        const res = await axiosClient.get(url)
        return res.data;
    }

}

export default orderAPI;