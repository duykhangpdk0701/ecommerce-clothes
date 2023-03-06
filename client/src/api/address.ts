import IAddress from "@/interfaces/Address";
import axiosClient from "./axiosClient";

const addressAPI = {
  getList: async (): Promise<IAddress[]> => {
    const url = "/api/v1/address";
    const res = await axiosClient.get(url);
    return res.data;
  },

  createNewAddress: async (
    name: string,
    address: string,
    phone: string,
    cityId: number,
    districtId: number,
    wardId: number
  ): Promise<any> => {
    const url = "api/v1/address";

    const reqData = {
      name,
      phone,
      city_id: cityId,
      district_id: districtId,
      ward_id: wardId,
      address,
    };

    const res = await axiosClient.post(url, reqData);

    return res.data;
  },
};

export default addressAPI;
