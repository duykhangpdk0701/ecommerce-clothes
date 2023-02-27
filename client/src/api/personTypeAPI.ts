import IGender from "@/interfaces/Gender";
import axiosClient from "./axiosClient";

const personTypeAPI = {
  getList: async (): Promise<IGender[]> => {
    const url = "/api/v1/item-person-type";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default personTypeAPI;
