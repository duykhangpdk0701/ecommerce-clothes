import axiosClient from "./axiosClient";
import { ICity, IDistrict, IWard } from "@/interfaces/Address";

const destinationAPI = {
  getListOfCites: async (): Promise<ICity[]> => {
    const url = "/api/v1/destination/city";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getListOfDistrictsFromCity: async (cityId: number): Promise<IDistrict[]> => {
    const url = `api/v1/destination/city/${cityId}`;
    const res = await axiosClient.get(url);
    return res.data;
  },

  getListOfWardsFromDistrict: async (districtId: number): Promise<IWard[]> => {
    const url = `api/v1/destination/district/${districtId}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default destinationAPI;
