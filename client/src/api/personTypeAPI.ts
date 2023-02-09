import axiosClient from "./axiosClient";

const personTypeAPI = {
  getList: async (): Promise<any[]> => {
    const url = "/api/v1/person-type";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default personTypeAPI;
