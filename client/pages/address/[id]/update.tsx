import addressAPI from "@/api/address";
import destinationAPI from "@/api/destinationAPI";
import UpdateAddressTemplate from "@/components/templates/address/updateAddress";
import UpdateAddressForm from "@/components/templates/address/updateAddress/UpdateAddressForm";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";
import { useAppDispatch } from "@/hooks/redux";
import AccountLayout from "@/layout/AccountLayout";
import { NextPageWithLayout } from "@/pages/_app";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement, useEffect } from "react";
import { SubmitHandler, useForm } from "react-hook-form";
import { useMutation, useQuery } from "react-query";
import * as yup from "yup";

export interface IAddressParams {
  name: string;
  phone: string;
  address: string;
  ward?: number;
  district?: number;
  city: number;
}

interface IUpdateAddressReq {
  id: string;
  name: string;
  cityId: number;
  districtId: number;
  wardId: number;
  address: string;
  phone: string;
}

const updateAddressSchema = yup.object({
  name: yup.string().required(),
  phone: yup.string().required(),
  address: yup.string().required(),
  ward: yup.number().required(),
  district: yup.number().required(),
  city: yup.number().required(),
});

const UpdateAddress: NextPageWithLayout = () => {
  const router = useRouter();
  const { id } = router.query;
  const dispatch = useAppDispatch();
  const { control, handleSubmit, getValues, watch, setValue } =
    useForm<IAddressParams>({
      resolver: yupResolver(updateAddressSchema),
    });

  const addressDetailIQuery = useQuery({
    queryKey: ["address-detail", id],
    queryFn: () => {
      if (id && typeof id !== "object") {
        return addressAPI.getById(id);
      }
      return undefined;
    },
    onSuccess: (data) => {
      if (data) {
        setValue("name", data.name);
        setValue("phone", data.phone);
        setValue("address", data.address);
        setValue("city", data.city_id);
        setValue("ward", data.ward_id);
        setValue("district", data.district_id);
      }
    },
    onError: () => {},
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
      id,
      name,
      address,
      phone,
      cityId,
      districtId,
      wardId,
    }: IUpdateAddressReq) => {
      return addressAPI.updateAddress(
        id,
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
    if (district && ward && id && typeof id !== "object") {
      addAddressMutation.mutate({
        id,
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

      <UpdateAddressTemplate
        addAddressForm={
          <UpdateAddressForm
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

UpdateAddress.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default UpdateAddress;
