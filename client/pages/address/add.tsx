import destinationAPI from "@/api/destinationAPI";
import AddAddressTemplate from "@/components/templates/address/addAddress";
import AddAddressForm from "@/components/templates/address/addAddress/AddAddressForm";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement, useEffect } from "react";
import { useMutation, useQuery } from "react-query";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import Head from "next/head";
import { SubmitHandler } from "react-hook-form/dist/types";
import addressAPI from "@/api/address";
import { useAppDispatch } from "@/hooks/redux";
import { useRouter } from "next/router";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

export interface IAddressParams {
  name: string;
  phone: string;
  address: string;
  ward?: number;
  district?: number;
  city: number;
}

interface IaddAddressReq {
  name: string;
  cityId: number;
  districtId: number;
  wardId: number;
  address: string;
  phone: string;
}

const addAddressSchema = yup.object({
  name: yup.string().required(),
  phone: yup.string().required(),
  address: yup.string().required(),
  ward: yup.number().required(),
  district: yup.number().required(),
  city: yup.number().required(),
});

const AddAddress = () => {
  const router = useRouter();
  const dispatch = useAppDispatch();
  const { control, handleSubmit, getValues, watch, setValue } =
    useForm<IAddressParams>({
      resolver: yupResolver(addAddressSchema),
    });

  const citesQuery = useQuery("city", destinationAPI.getListOfCites);

  const districtQuery = useQuery({
    queryKey: ["district", watch("city")],
    queryFn: () => {
      if (getValues("city")) {
        return destinationAPI.getListOfDistrictsFromCity(getValues("city"));
      }
      return undefined;
    },
  });

  useEffect(() => {
    setValue("district", undefined, { shouldValidate: false });
  }, [watch("city")]);

  useEffect(() => {
    setValue("ward", undefined, { shouldValidate: false });
  }, [watch("district")]);

  const wardQuery = useQuery({
    queryKey: ["ward", watch("district")],
    queryFn: () => {
      if (getValues("district")) {
        return destinationAPI.getListOfWardsFromDistrict(
          getValues("district") as any
        );
      }
      return undefined;
    },
  });

  const addAddressMutation = useMutation({
    mutationKey: ["addresss"],
    mutationFn: ({
      name,
      address,
      phone,
      cityId,
      districtId,
      wardId,
    }: IaddAddressReq) => {
      return addressAPI.createNewAddress(
        name,
        address,
        phone,
        cityId,
        districtId,
        wardId
      );
    },
    onSuccess: async () => {
      await router.push("/order");
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Create Address successfully",
        })
      );
      router.push("/address");
    },
    onError: (error: any) => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: error.message,
        })
      );
    },
  });

  const onSubmit: SubmitHandler<IAddressParams> = (data) => {
    const { name, address, phone, city, district, ward } = data;
    if (district && ward) {
      addAddressMutation.mutate({
        name,
        address,
        phone,
        cityId: city,
        districtId: district,
        wardId: ward,
      });
    }
  };

  return (
    <>
      <Head>
        <title>Address | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <AddAddressTemplate
        addAddressForm={
          <AddAddressForm
            control={control}
            handleSubmit={handleSubmit}
            onSubmit={onSubmit}
            cities={citesQuery.data}
            isLoadingCity={citesQuery.isLoading}
            district={districtQuery.data}
            isLoadingDistrict={districtQuery.isLoading}
            ward={wardQuery.data}
            isLoadingWard={wardQuery.isLoading}
            isLoadingSubmit={addAddressMutation.isLoading}
          />
        }
      />
    </>
  );
};

AddAddress.getLayout = function (page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default AddAddress;
