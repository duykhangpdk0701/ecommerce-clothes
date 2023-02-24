import userAPI from "@/api/userAPI";
import EditProfileTemplate from "@/components/templates/profile/edit";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement, useState } from "react";
import { useMutation, useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import * as yup from "yup";
import { useRouter } from "next/router";
import { yupResolver } from "@hookform/resolvers/yup";
import { SubmitHandler, useForm } from "react-hook-form";

export interface IUpdateUserProfileParams {
  firstName: string;
  lastName: string;
  email: string;
  phone: string;
  birthDate: string;
}
const updateUserProfileSchema = yup.object({
  firstName: yup.string().required(),
  lastName: yup.string().required(),
  email: yup.string().email().required(),
  phone: yup.string().required(),
  birthDate: yup.date().required(),
});

const EditProfile: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm<IUpdateUserProfileParams>({
    defaultValues: {
      firstName: "",
      lastName: "",
      email: "",
      phone: "",
      birthDate: "",
    },
    resolver: yupResolver(updateUserProfileSchema),
  });

  const userQuery = useQuery({
    queryKey: "user",
    queryFn: () => userAPI.getUserDetail(),
    onSuccess: (data) => {
      data?.profile.first_name &&
        setValue("firstName", data.profile.first_name);
      data?.profile.last_name && setValue("lastName", data.profile.last_name);
      data?.email && setValue("email", data.email);
      data?.profile.phone && setValue("phone", data.profile.phone);
      data?.profile.birthDate && setValue("firstName", data.profile.birthDate);
    },
  });

  const updateProfileUserMutation = useMutation({
    mutationKey: "user",
    mutationFn: ({
      firstName,
      lastName,
      email,
      phone,
      birthDate,
    }: IUpdateUserProfileParams) => {
      setLoading(true);
      return userAPI.updateUserProfile(
        firstName,
        lastName,
        email,
        phone,
        birthDate
      );
    },
    onSuccess: (data) => {
      setLoading(false);
    },
    onError: (err: any) => {
      setLoading(false);
      console.log(err);
    },
  });

  const onSubmit: SubmitHandler<IUpdateUserProfileParams> = async (data) => {
    const { firstName, lastName, phone, email, birthDate } = data;

    await updateProfileUserMutation.mutateAsync({
      firstName,
      lastName,
      phone,
      email,
      birthDate,
    });

    console.log(data);
  };

  return (
    <EditProfileTemplate
      control={control}
      onSubmit={onSubmit}
      handleSubmit={handleSubmit}
      errors={errors}
      isLoading={loading}
      errorResMessage={error}
    />
  );
};

EditProfile.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default EditProfile;
