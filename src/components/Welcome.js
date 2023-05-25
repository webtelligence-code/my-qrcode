import React from 'react'
import { useTranslation } from 'react-i18next'

const Welcome = () => {
  const { t } = useTranslation();

  return (
    <h1 className='text-center'>{t('greeting')}</h1>
  )
}

export default Welcome